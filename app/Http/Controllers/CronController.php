<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AppSettings;
use DB;
use Auth;
use Mail;
use Assets;
use Crypt;
use Session;
use Validator;
use App\LeadershipBonus;
use App\PointTable;
use App\Commission;
use App\Sponsortree;
use App\MatchingBonus;
use App\LoyaltyUsers;
use App\LoyaltyBonus;
use App\UserInactiveHistory;
use App\PurchaseHistory;
use App\Tree_Table;
use App\PairingHistory;
use App\Balance;
use App\Payout;
use App\PendingTransactions;
use App\CarryForwardHistory;
use App\Models\Marketing\EmailCampaign;
use App\User;
use App\AutoResponse;
use App\Emails;
use App\Jobs\campaignResponderEmail;
use App\Jobs\autoRespondermail;
use App\Models\Marketing\Contact;
use App\LevelCommissionSettings;
use App\SponsorCommission;
use App\Ranksetting;
use App\Jobs\SendEmail;
use App\Settings;
use App\InfluencerTree;
use Response;

use Artisan;
use Carbon;

class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leadership_bonus = LeadershipBonus::all();
      //where('point_table.left_carry','>',0)
      // ->where('point_table.right_carry','>',0)
        $users_list = PointTable::where('point_table.user_id', '>', 1)
                        ->join('users', 'users.id', '=', 'point_table.user_id')
                        ->select('point_table.left_carry', 'point_table.right_carry', 'point_table.user_id', 'users.package')
                        ->get();
        try {
            DB::beginTransaction();
            foreach ($users_list as $key => $value) {
                $week_total = 0 ;
                $total_bonus = 0 ;
                $min_pv = min($value->left_carry, $value->right_carry);
                $first_pv = $min_pv - $leadership_bonus[$value->package - 1]->first_limit ;
                $second_pv = $min_pv - $leadership_bonus[$value->package - 1]->first_limit - $leadership_bonus[$value->package - 1]->second_limit ;
                $third_pv = $min_pv - $leadership_bonus[$value->package - 1]->first_limit - $leadership_bonus[$value->package - 1]->second_limit - $leadership_bonus[$value->package - 1]->third_limit ;

                CarryForwardHistory::create([
                'user_id'=>$value->user_id,
                'total_left'=>$value->left_carry,
                'total_right'=>$value->right_carry,
                'left'=>$value->left_carry - $min_pv ,
                'right'=>$value->right_carry - $min_pv ,
                ]);

              // ECHO $value->package  ;

                if ($min_pv == 0) {
                        continue;
                }

                PointTable::where('user_id', $value->user_id)->decrement('left_carry', $min_pv);
                PointTable::where('user_id', $value->user_id)->decrement('right_carry', $min_pv);

                $pairing_history = PairingHistory::create([
                'user_id'=>$value->user_id,
                'total_left'=>$value->left_carry,
                'total_right'=>$value->right_carry,
                'left'=>$value->left_carry - $min_pv,
                'right'=>$value->right_carry - $min_pv,
                ]);

                $pairing_history = PairingHistory::find($pairing_history->id);


                if ($first_pv > 0) {
                          $amount = $leadership_bonus[$value->package - 1]->first_limit * $leadership_bonus[$value->package - 1]->first_percent  / 100 ;
                          $week_total += $amount ;

                    if ($week_total >= $leadership_bonus[$value->package - 1]->week_limit) {
                        $amount =  $leadership_bonus[$value->package - 1]->week_limit ;
                    }

                      Commission::create([
                        'user_id'=>$value->user_id ,
                        'from_id'=>$value->user_id ,
                        'total_amount'=> $amount ,
                        'payable_amount'=> $amount ,
                        'payment_type'=>'pairing_bonus'
                      ]);
                          Commission::updateUserBalance($value->user_id, $amount);

                          $pairing_history->first_percent = $leadership_bonus[$value->package - 1]->first_percent;
                          $pairing_history->first_amount = $leadership_bonus[$value->package - 1]->first_limit;
                          $pairing_history->first_bonus = $amount;
                          $pairing_history->save();


                          $total_bonus = $total_bonus + $amount ;
                } else {
                    $amount = $min_pv * $leadership_bonus[$value->package - 1]->first_percent  / 100 ;

                    $week_total += $amount ;

                    if ($week_total >= $leadership_bonus[$value->package - 1]->week_limit) {
                        $amount =  $leadership_bonus[$value->package - 1]->week_limit ;
                    }

                      Commission::create([
                    'user_id'=>$value->user_id ,
                    'from_id'=>$value->user_id ,
                    'total_amount'=> $amount ,
                    'payable_amount'=> $amount ,
                    'payment_type'=>'pairing_bonus'
                      ]);
                    Commission::updateUserBalance($value->user_id, $amount);
                    $total_bonus = $total_bonus + $amount ;


                    $pairing_history->first_percent = $leadership_bonus[$value->package - 1]->first_percent;
                    $pairing_history->first_amount = $min_pv;
                    $pairing_history->first_bonus = $amount;
                    $pairing_history->save();


                    self::matchingbonus($value->user_id, $total_bonus);

                    continue;
                }

                if ($second_pv > 0) {
                    $amount = $leadership_bonus[$value->package - 1]->second_limit * $leadership_bonus[$value->package - 1]->second_percent  / 100 ;

                    if (( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit) {
                        $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                    }
                    Commission::create([
                    'user_id'=>$value->user_id ,
                    'from_id'=>$value->user_id ,
                    'total_amount'=> $amount ,
                    'payable_amount'=> $amount ,
                    'payment_type'=>'pairing_bonus'
                    ]);
                    Commission::updateUserBalance($value->user_id, $amount);

                    $week_total += $amount ;

                    $total_bonus = $total_bonus + $amount ;


                    $pairing_history->second_percent = $leadership_bonus[$value->package - 1]->second_percent;
                    $pairing_history->second_amount = $leadership_bonus[$value->package - 1]->second_limit;
                    $pairing_history->second_bonus = $amount;
                    $pairing_history->save();
                } else {
                    $pv = $min_pv  - $leadership_bonus[$value->package - 1]->first_limit ;
                    $amount = ( $pv )  * $leadership_bonus[$value->package - 1]->second_percent  / 100 ;

                    if (( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit) {
                        $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                    }


                    Commission::create([
                    'user_id'=>$value->user_id ,
                    'from_id'=>$value->user_id ,
                    'total_amount'=> $amount ,
                    'payable_amount'=> $amount ,
                    'payment_type'=>'pairing_bonus'
                    ]);

                    Commission::updateUserBalance($value->user_id, $amount);

                    $week_total += $amount ;

                    $total_bonus = $total_bonus + $amount ;

                    $pairing_history->second_percent = $leadership_bonus[$value->package - 1]->second_percent;
                    $pairing_history->second_amount = $pv;
                    $pairing_history->second_bonus = $amount;
                    $pairing_history->save();


                    self::matchingbonus($value->user_id, $total_bonus);

                    continue;
                }

                if ($third_pv > 0) {
                      $amount = $leadership_bonus[$value->package - 1]->third_limit * $leadership_bonus[$value->package - 1]->third_percent  / 100 ;

                    if (( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit) {
                        $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                    }

                    Commission::create([
                    'user_id'=>$value->user_id ,
                    'from_id'=>$value->user_id ,
                    'total_amount'=> $amount ,
                    'payable_amount'=> $amount ,
                    'payment_type'=>'pairing_bonus'
                    ]);
                             Commission::updateUserBalance($value->user_id, $amount);
                              $week_total += $amount ;

                              $total_bonus = $total_bonus + $amount ;

                               $pairing_history->third_percent = $leadership_bonus[$value->package - 1]->third_percent;
                            $pairing_history->third_amount = $leadership_bonus[$value->package - 1]->third_limit;
                            $pairing_history->third_bonus = $amount;
                            $pairing_history->save();

                              self::matchingbonus($value->user_id, $total_bonus);

                               continue ;
                } else {
                        $pv = $min_pv  - $leadership_bonus[$value->package - 1]->second_limit - $leadership_bonus[$value->package - 1]->first_limit ;
                         $amount = ( $pv )  * $leadership_bonus[$value->package - 1]->third_percent  / 100 ;

                    if (( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit) {
                        $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                    }


                    Commission::create([
                    'user_id'=>$value->user_id ,
                    'from_id'=>$value->user_id ,
                    'total_amount'=> $amount ,
                    'payable_amount'=> $amount ,
                    'payment_type'=>'pairing_bonus'
                    ]);
                        Commission::updateUserBalance($value->user_id, $amount);

                         $week_total += $amount ;

                         $total_bonus = $total_bonus + $amount ;

                          $pairing_history->third_percent = $leadership_bonus[$value->package - 1]->third_percent;
                        $pairing_history->third_amount = $pv;
                        $pairing_history->third_bonus = $amount;
                        $pairing_history->save();

                         self::matchingbonus($value->user_id, $total_bonus);

                        continue;
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        echo " Leader bonus and Matching bonus calculation completed " ;
    }

    public function matchingbonus($user_id, $amount)
    {
        Sponsortree::$upline_users = array();
        Sponsortree::getAllUpline($user_id);
        $upline_users = Sponsortree::$upline_users;

        



        $matching_bonus = MatchingBonus::all() ;
        foreach ($upline_users as $key => $value) {
            if ($value['type'] == 'yes') {
                $key = $key + 1 ;
                $index = $value['package'] - 1 ;
                $level = "level_$key";
                $payable_amount = $amount * $matching_bonus[$index]->$level / 100 ;
                if ($payable_amount  and $value['user_id'] > 1) {
                    Commission::create([
                    'user_id'=>$value['user_id'] ,
                    'from_id'=>$user_id ,
                    'total_amount'=> $payable_amount ,
                    'payable_amount'=> $payable_amount ,
                    'payment_type'=>'matching_bonus'
                    ]);
                    Commission::updateUserBalance($value['user_id'], $payable_amount);
                }
            }
        }
    }


/**

Cron will run at the first day of every month with the details of last month

*/

    public function makelist()
    {
    /*
        $loyaltybonus_date = date('Y-m-d',strtotime("-1 days"));

         $loyalty_bonus_settings = LoyaltyBonus::find(1);

        $loop_limit = $loyalty_bonus_settings->bonus_duration / 3 ;

        $variable = PurchaseHistory::whereYear('created_at', '=', date('Y',strtotime("-1 days")))
                    ->whereMonth('created_at', '=', date('m',strtotime("-1 days")))
                    ->select('user_id',DB::raw('SUM(BV) as BV'))
                    ->having(DB::raw('SUM(BV)'), '>=', $loyalty_bonus_settings->personal_sales)
                    ->groupBY('user_id')
                    ->get();

        foreach ($variable as $key => $value) {
        for ($i=0; $i < $loop_limit; $i++) {
            $index = $i*3 ;
            $month = date('Y-m-d',strtotime("+$index months",strtotime($loyaltybonus_date)));
            if (LoyaltyUsers::where('month', '=', $month)->where('user_id', '=', $value->user_id)->exists()) {
                   LoyaltyUsers::where('month', '=', $month)
                                ->where('user_id', '=', $value->user_id)
                                ->increment('pv',$value->BV);
            }else{
                   LoyaltyUsers::create([
                    'user_id'=>$value->user_id,
                    'pv'=>$value->BV,
                    'month'=>$month
                    ]);
            }
        }
        }
        */
        $loyaltybonus_date = date('Y-m-d H:i:00');
        $loyaltybonus_end_date =date('Y-m-d H:i:00');
        $loyaltybonus_start_date = date('Y-m-d H:i:00', strtotime("-10 minutes", strtotime($loyaltybonus_date)));
        $loyalty_bonus_settings = LoyaltyBonus::find(1);
        $loop_limit = $loyalty_bonus_settings->bonus_duration / 3 ;
        echo " Taking sales from $loyaltybonus_start_date  to $loyaltybonus_end_date" ;
        $variable = PurchaseHistory::where('created_at', '>', $loyaltybonus_start_date)
                  ->where('created_at', '<=', $loyaltybonus_end_date)
                  ->where('status', '=', 'approved')
                  ->select('user_id', DB::raw('SUM(BV) as BV'))
                  ->having(DB::raw('SUM(BV)'), '>=', $loyalty_bonus_settings->personal_sales)
                  ->groupBY('user_id')
                  ->get();
        foreach ($variable as $key => $value) {
            for ($i=0; $i < $loop_limit; $i++) {
                $index = $i*3*10;
                $month = date('Y-m-d H:i:00', strtotime("+$index minutes", strtotime($loyaltybonus_date)));
                if (LoyaltyUsers::where('month', '=', $month)->where('user_id', '=', $value->user_id)->exists()) {
                     LoyaltyUsers::where('month', '=', $month)
                            ->where('user_id', '=', $value->user_id)
                            ->increment('pv', $value->BV);
                } else {
                     LoyaltyUsers::create([
                    'user_id'=>$value->user_id,
                    'pv'=>$value->BV,
                    'month'=>$month
                      ]);
                }
            }
        }
    }

    public function loyaltybonus()
    {
      // $loyaltybonus_date = date('Y-m-d',strtotime("-1 days"));
      // $loyaltybonus_date = date('Y-m-d H:i:00');
        $loyaltybonus_date = $loyaltybonus_end_date = date('Y-m-d H:i:00');
        $loyaltybonus_start_date = date('Y-m-d H:i:00', strtotime("-10 minutes", strtotime($loyaltybonus_date)));
        echo "   loyalty bonus for   " .$loyaltybonus_date ;
        echo "   <br/>  working now ----" ;
      // die('ssssss');
        $loyalty_bonus = LoyaltyBonus::find(1);
      // $list_users = LoyaltyUsers::where('month','=',$loyaltybonus_date)->get();
        $list_users = LoyaltyUsers::where('month', '=', $loyaltybonus_date)->get();

        $loyalty_bonus_settings = LoyaltyBonus::find(1);

        $total_sale = PurchaseHistory::where('created_at', '>', $loyaltybonus_start_date)
        ->where('created_at', '<=', $loyaltybonus_end_date)
        ->where('status', '=', 'approved')
      // ->whereYear('created_at', '=', date('Y',strtotime("-1 days")))
      // ->whereMonth('created_at', '=', date('m',strtotime("-1 days")))
        ->sum('BV');
        echo "total sale $total_sale" ;
        $monthly_loaylty=0;
        foreach ($list_users as $key => $value) {
            $monthly_loaylty += $value->pv;
        }
        echo "   monthly_loaylty  sale $monthly_loaylty" ;
        foreach ($list_users as $key => $value) {
            $amount = round(( $total_sale *  $loyalty_bonus->bonus_percentage / 100 ) * ($value->pv / $monthly_loaylty), 2) ;
            if ($amount) {
                Commission::create([
                'user_id'=>$value->user_id ,
                'from_id'=>$value->user_id ,
                'total_amount'=> $amount ,
                'payable_amount'=> $amount ,
                'payment_type'=>'loyalty_bonus'
                ]);
                Commission::updateUserBalance($value->user_id, $amount);
            }
        }
        echo " Completed loyalty bonus ";
    }

  /* Every month starting minute ..*/
    public function checklastpurchase($id)
    {
        return PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d H:i:00', strtotime('-10 minutes')))
                                // ->select('purchase_history.user_id',DB::raw('SUM(BV) as BV'))
        ->where('purchase_history.user_id', '=', $id)
        ->sum('BV');
    }
    public function monthly_maintenance()
    {
        $users = User::where('id', '>', 1)->get();
        foreach ($users as $key => $value) {
            Sponsortree::where('user_id', '=', $value->id)->update(['type'=>'no']);
            Tree_Table::where('user_id', '=', $value->id)->update(['type'=>'no']);
            User::where('id', '=', $value->id)->update(['monthly_maintenance'=>0]);
        }
        echo "monthly_maintenance completed <br>"  .date('Y-m-d H:i:00', strtotime('-10 minutes'));
    }

    public function trace_back()
    {
        $users = User::where('id', '>', 1)->get();
        foreach ($users as $key => $value) {
            Commission::traceBack($value->id);
        }
        echo "trace back completed <br>"  ;
    }

    public function payout()
    {
        $variable = Balance::where('balance', '>', 0)->select('user_id', 'balance')->get();
        foreach ($variable as $users => $value) {
            Payout::create([
            'user_id'        => $value->user_id,
            'amount'        => $value->balance,
            'status'   => 'released'
            ]);
             Balance::updateBalance($value->user_id, $value->balance);
        }
        echo "Payout completed <br>" ;
    }

    public function autoresponse()
    {
        $response_date = date('d');
        $body = AutoResponse::where('date', '=', $response_date)->select('subject', 'content')->get();
        $content = DB::table('auto_response')->lists('content');
        $res = AutoResponse::all();
        $users=User::all();
        $email = Emails::find(1) ;
        foreach ($body as $bdy) {
            $content = $bdy->content;
            $data = ['content' => $content
            ];
            Mail::send(['html' => 'emails.autoresponse'], $data, function ($mail) use ($bdy, $email, $users) {
                foreach ($users as $user) {
                    $mail->to($user['email'])->subject($bdy->subject);
                }
            });
        }
        echo "Mail has been sent successfully" ;
    }
       
  // public function backup()
  // {
  //   ini_set('memory_limit', '-1');
  //     ini_set('max_execution_time', 30000);
  //  Artisan::call('backup:run');
  //   // php artisan backup:run --only-db
  // }

    public function backup()
    {
        $radio = option('app.database_manager');
        if ($radio == 1) {
            self::download_db();
        } elseif ($radio == 2) {
            if (date('N') == 1) {
                self::download_db();
            }
        } elseif ($radio == 3) {
            if (date('Y-m-d') == date('Y-m-01')) {
                self::download_db();
            }
        } elseif ($radio == 4) {
            if (date('Y-m-d') == date('Y-01-01')) {
                self::download_db();
            }
        }
        echo "success";
    }

    public function download_db()
    {
        $filename = "backup-".date("d-m-Y-H-i-s").".sql";
        $mysqlPath = "storage/files/";
        $DATABASE="noureddine.cloudmlm.online";
        $DBUSER="root";
        $DBPASSWD="0509a6c34e56a818ce90f326bd7cb3550d897601bb4c0e91";
        try {
            exec('/usr/bin/mysqldump -u '.$DBUSER.' -p'.$DBPASSWD.' '.$DATABASE.' | gzip --best > '.storage_path() . "/files/" . $filename);
            $email = Emails::find(1) ;
            $app_settings = AppSettings::find(1) ;
            Mail::send('emails.getdb', ['filename'=>$filename, 'email'=>$email,'company_name'=>$app_settings->company_name], function ($m) use ($email, $filename) {
                $m->to("dijilpalakkal@gmail.com", "Dijil")->subject('DB')->from($email->from_email, $email->from_name)
                ->attach(storage_path() . "/files/" .$filename);
            });
        } catch (Exception $e) {
            return "0".$e->errorInfo; //some error
        }
    }

    public function emailCampaigns()
    {

        $mails=EmailCampaign::all();

        foreach ($mails as $key => $mail) {
            campaignResponderEmail::dispatch($mail)->delay(Carbon::now()->addSeconds(10));
        }
        dd("done");
    }

    public function testmail()
    {   

        // $users = User::join('user_balance','user_balance.user_id','users.id')
        //             ->where('admin',0)->where('balance','>',0)
        //             ->select('users.id','balance')->get();

        // foreach ($users as $key => $value) {
        //     if($value->balance > 0){
        //         Payout::create([
        //             'user_id'        => $value->id,
        //             'amount'         => $value->balance,
        //             'payment_type'   => 'weekly_automatic_payout',
        //             'payment_mode'   => 1,
        //             'status'         => 'pending'
        //          ]);
        //         Balance::where('user_id',$value->id)->decrement('balance',$value->balance);
        //     }
        // }
        dd("............Done............."); 
        // dd(123);
        // downline and referal count
        $users = User::where('admin','!=',1)->get();
        foreach ($users as $key => $abc) {
            $dd = Tree_Table::where('placement_id',$abc->id)->get();
            foreach ($dd as $key => $value) {
                $array[$abc->id]['downline'][$value->leg] = 0;
                if($value->sponsor == $abc->id)
                    $array[$abc->id]['direct'][$value->leg] = 1;
                else
                    $array[$abc->id]['direct'][$value->leg] = 0;

                if($value->user_id > 0){
                  $variable = [];
                  Tree_Table::$downline = [];
                  Tree_Table::getDownlineuser(true,$value->user_id);
                  $variable = Tree_Table::$downline;
                  $array[$abc->id]['downline'][$value->leg] = count($variable)+1;
                  foreach ($variable as $key => $val) {

                      if($val['sponsor'] == $abc->id){
                          $array[$abc->id]['direct'][$value->leg] = $array[$abc->id]['direct'][$value->leg]+1;
                      }
                  }
                }
            }
        }
        foreach ($array as $key => $value) {
            PointTable::where('user_id',$key)->update([
                'left_user'   =>  $value['downline']['L'],
                'right_user'  =>  $value['downline']['R'],
                'left_puser'  =>  $value['direct']['L'],
                'right_puser' =>  $value['direct']['R']
            ]);
        }
        dd(123);
        // Mail::send(
        //     'app.admin.campaign.campaign.campaigns-default-email',
        //     ['email'         => 'shilpavijayan33@gmail.com',
        //                 'company_name'   => 'dsff',
        //                 'firstname'      => 'dsf',
        //                 'name'           => 'dgdg',
        //                 'login_username' => 'dgdfg',
        //                 'password'       => 'dffh',
        //             ],
        //     function ($m) {
        //                 $m->to('shilpavijayan33@gmail.com', 'dgg')->subject('Successfully registered')->from('shilpavijayan33@gmail.com', 'dsg');
        //     }
        // );
        dd("sf");
    }

    public function autocampaign()
    {

        $mail=AutoResponse::find(1);
        // dd($mails);
        // foreach ($mails as $key => $mail) {
      
            
               $today=date('Y-m-d');
               $emailcampaign=EmailCampaign::find($mail->campaign);
               $send_date=date('Y-m-d', strtotime($emailcampaign->datetime. ' + '.$mail->date.' days'));
               // dd($send_date);

                // if($send_date == $today){
              
               
                    $users=Contact::where('list_id', $emailcampaign->customer_group)->select('name', 'email')->get();
                    // dd($users);
      
        foreach ($users as $key => $user) {
            Mail::send(
                'emails.autores',
                ['content'         => $mail->content,
                        
                           ],
                function ($m) use ($user, $emailcampaign) {
                    $m->to($user->email, $user->name)->subject('Successfully registered')->from($emailcampaign->from_email, $emailcampaign->first_name);
                }
            );
            // $emailclass = new autoRespondermailable($this->autoresponder,$emailcampaign->first_name,$emailcampaign->from_email);
        }


                        
                    // }
                 
                // }
         dd("done");
    }

    public function testcommission()
    {
      // LevelCommissionSettings::levelCommission(5,1);
        SponsorCommission::sponsorCommission(5, 1, 4);
    }



    public function faststrat()
    {
        $user_arrs=[];
             $results=self::getfourupllins(5, 1, $user_arrs);
             // dd($results);
        foreach ($results as $key => $results) {
            $fast_start = option('app.fast_start');
            dd($fast_start);
        }
    }

    public static function getfourupllins($upline_users, $level = 1, $uplines)
    {
        if ($level > 4) {
            return $uplines;
        }
  
        $upline=Sponsortree::join('users', 'users.id', '=', 'sponsortree.sponsor')->where('user_id', $upline_users)->where('sponsortree.type', '=', 'yes')->value('sponsor');

        if ($upline > 0) {
            $uplines[]=$upline;
        }

        if ($upline == 1) {
            return $uplines;
        }
   
        return self::getfourupllins($upline, ++$level, $uplines);
    }

    public function testcomm()
    {

        LevelCommissionSettings::levelCommission(96, 2);
        dd("sf");
    }
    public function rankupdates()
    {
        Ranksetting::poolBonus();
        // Ranksetting::newRankupdate(7);
    }

    // every day
    public function userExpiry(){
        $today = date("Y-m-d");
        $userData = User::where('expiry_date','<',$today)->select('expiry_date','id','created_at')->where('active','yes')->where('admin','!=',1)->get();
        foreach ($userData as $key => $value) {
            $recruit = User::where('sponsor_id',$value->id)->count();
            if($recruit == 0){
                User::where('id',$value->id)->update(['active'=>'no']);
                UserInactiveHistory::create([
                    'user_id'=>$value->id,
                    'join_date' => date('Y-m-d',strtotime($value->created_at))
                ]);
            }
        }
        dd('...........User Expiry Checked Successfully..........');
    }
    // every day
    public function userExpiryMail(){
        $today = date("Y-m-d");
        $nextmonthtoday = date("Y-m-d", strtotime("+1 month", strtotime($today)));
        $userData = User::where('expiry_date',$nextmonthtoday)->where('active','yes')->where('admin','!=',1)->get();
        foreach ($userData as $key => $value) {
            $recruit = User::where('sponsor_id',$value->id)->count();
            if($recruit == 0){
                SendEmail::dispatch($value,$value->email,$value->username,'termination')->delay(Carbon::now()->addSeconds(5));
            }
        }
        dd('...........User Expiry Checked Successfully..........');
    }
    
    // first day of every month
    public function monthlyMaintenance(){

        ini_set('max_execution_time', 30000); 
        set_time_limit(30000);
    
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $startDate = date('Y-m-d 00:00:00',strtotime($start));
        $endDate   = date('Y-m-d 23:59:59',strtotime($end));
        $users = User::where('admin',0)->whereNotIn('id',[8,1042])->pluck('id');
        foreach ($users as $key => $value) {
            $P_monthpv = PurchaseHistory::where('user_id',$value)->where('created_at', '>=', $startDate)
                      ->where('created_at', '<=',$endDate)->where('type','product')->where('pay_by','!=','register_point')->sum('total_bv');
            if($P_monthpv < 100){
                $com_earned = Commission::where('user_id',$value)->where('created_at','>=',$startDate)
                                    ->where('created_at','<=',$endDate)->sum('total_amount');
                Balance::where('user_id',$value)->decrement('balance',$com_earned);
                Commission::where('user_id',$value)->where('created_at','>=',$startDate)
                          ->where('created_at','<=',$endDate)->delete();
            }
        }
    }
    // first day of every month
    public function updateWeeklyPayout(){

        ini_set('max_execution_time', 30000); 
        set_time_limit(30000);

        $users = User::where('weekly_payout','yes')->pluck('id');
        foreach ($users as $key => $value)
            User::where('id',$value)->update(['weekly_payout' => 'no']);
        
        dd("............Done.............");
    }
    // 8 th day of every month
    public function checkAutomaticPayout(){

        ini_set('max_execution_time', 30000); 
        set_time_limit(30000);
    
        $start = new Carbon('first day of this month');
        $startDate = date('Y-m-d 00:00:00',strtotime($start));

        $users = User::where('admin',0)->pluck('id');
        foreach ($users as $key => $value) {
            $firstWeekDate = date('Y-m-d 00:00:00',strtotime("+7 day", strtotime($start)));
            $firstweekpv = PurchaseHistory::where('user_id',$value)->where('created_at', '>=', $startDate)
                            ->where('created_at', '<=',$firstWeekDate)->where('type','product')->where('pay_by','!=','register_point')->sum('total_bv');
            if($firstweekpv >= 100)
                User::where('id',$value)->update(['weekly_payout' => 'yes']);
        }
    } 
    // 1,8,15,22 th day of every month
    public function releaseAutomaticPayout(){

        ini_set('max_execution_time', 30000); 
        set_time_limit(30000);
    
        $start = new Carbon('first day of this month');
        $startDate = date('Y-m-d 00:00:00',strtotime($start));

        $currentdate = date('d');
        $premonthstart = new Carbon('first day of last month');
        $premonthend = new Carbon('last day of last month');
        $premonthstartdate = date('Y-m-d 00:00:00',strtotime($premonthstart));
        $premonthenddate = date('Y-m-d 23:59:59',strtotime($premonthend));

        $users = User::join('user_balance','user_balance.user_id','users.id')
                    ->where('admin',0)->where('balance','>',0)
                    ->select('users.id','weekly_payout','balance')->get();

        foreach ($users as $key => $value) {
            if($value->weekly_payout=='yes'){
                if($value->balance > 0){
                    Payout::create([
                        'user_id'        => $value->id,
                        'amount'         => $value->balance,
                        'payment_type'   => 'weekly_automatic_payout',
                        'payment_mode'   => 1,
                        'status'         => 'pending'
                     ]);
                    Balance::where('user_id',$value->id)->decrement('balance',$value->balance);
                }
            }
            else{
                if($currentdate == 1){
                    $amount = Commission::where('created_at', '>=', date('Y-m-d 00:00:00', strtotime($premonthstartdate)))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($premonthenddate)))->where('user_id',$value->id)->sum('total_amount');
                    if($amount > 0){
                        if($amount <= $value->balance){
                            Payout::create([
                                'user_id'        => $value->id,
                                'amount'         => $amount,
                                'payment_type'   => 'monthly_automatic_payout',
                                'payment_mode'   => 1,
                                'status'         => 'pending'
                            ]);
                            Balance::where('user_id',$value->id)->decrement('balance',$amount);
                        }
                        else{
                            Payout::create([
                                'user_id'        => $value->id,
                                'amount'         => $value->balance,
                                'payment_type'   => 'monthly_automatic_payout',
                                'payment_mode'   => 1,
                                'status'         => 'pending'
                            ]);
                            Balance::where('user_id',$value->id)->decrement('balance',$value->balance);
                        }
                    }
                }
            }
        }
        dd("............Done.............");
    }    
     public function salesBonus($purchaseID)
    {
       
        $data = PurchaseHistory::where('id',$purchaseID)->first();
        $user_id = $data->user_id;

        $sponsor_id = 1;//need to get
        $next_bonus = User::where('id',$sponsor_id)->value('next_bonus');
        $settings = Settings::first();
        // $data->count = 3;
        // if ($data->count == 1) {

        //     $bonus = "bonus_".$next_bonus;
        //     $amount = $settings->$bonus; //bonus_1 and bonus_2
            
        //     if ($next_bonus == 1) 
        //         $bns = 2;
        //     else
        //         $bns =1;

        //     User::where('id',$sponsor_id)->update(['next_bonus'=>$bns]);

        // }
        // elseif ($data->count % 2 == 0) {
        //     //even number
        //     $amount = ($data->count / 2) * ($settings->bonus_1+$settings->bonus_2); //(65+35)
        // }
        // else{
            $amount = 0;
            $flag   = $next_bonus;
            for ($i=0; $i < $data->count; $i++) { 

                $bonus = "bonus_".$flag;
                $value = $settings->$bonus;
                $amount = $amount + $value;

                if ($flag == 1) 
                    $flag = 2;
                else
                    $flag =1;
            }
            User::where('id',$sponsor_id)->update(['next_bonus'=>$flag]);

        // }

        if (isset($amount)) {
             Commission::create([
                'user_id'=>$sponsor_id,
                'from_id'=>$user_id,
                'total_amount'=>$amount,
                'tds'=>$amount,
                'service_charge'=>$next_bonus,//store next_bonus.
                'payable_amount'=>$amount,
                'payment_type'=>'sales_bonus',
                ]);
        }

        dd("Done");

    }

    


public function massregistration($sponsor_id,$count)
    {
       
        DB::beginTransaction();  

        $sponsor_name=User::where('id',$sponsor_id)->value('username');
        $last_entry=Tree_Table::where('sponsor',$sponsor_id)->max('user_id');
        $usr_tbl_id=User::max('id');//to set proper username
    
        if(isset($sponsor_name)){
     
        $product = [];
        $product[0]['name'] = 'miracle Name';
        $product[0]['quantity'] = 2;
        $product[0]['total_price'] = 140;
        $product[0]['type'] = 'package';
    
            for ($i= 1 ; $i <= $count; $i++) { 


        $data                           = array();
        $data['sponsor']                = $sponsor_name;
        $data['purchase']               = $sponsor_name;
        $data['ic_number']              = '123'.'_'.($usr_tbl_id+$i);
        $data['username']               = $sponsor_name.'_'.($usr_tbl_id+$i);
        $data['firstname']              = 'N';
        $data['lastname']               = 'C';
        $data['email']                  = $sponsor_name.'_'.($usr_tbl_id+$i).'@gmail.com';
        $data['phone']                  = '+91 1234567894';
        $data['dateofbirth']            = '13-10-1993';
        $data['facebook_username']      = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['WeChat_id']              = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['Instagram_Id']           = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['tiktok_id']              = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['Shopee_Shop_Name']       = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['Lazada_Shop_name']       = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['twitter_username']       = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['youtube_username']       = 'facebook'.'_'.($usr_tbl_id+$i);
        $data['file_name']              = '7890';
        $data['password']               = '123456';
        $data['package']                = 1;
        $data['product']                = $product;
        $data['product_details']        = 'product details';
        $data['total_quantity']         = 2;
        $data['total_price']            = 250;
        $data['address']                = 'address1';
        $data['address2']               = 'address2';
        $data['city']                   = 'calicut';
        $data['zip']                    = '673301';
        $data['country']                = 'IN';
        $data['state']                  = 'KL';
        $data['bank_file']              = '';
        $data['reg_by']                 = 'null';
        $data['reg_type']               = 'checkout_reg';
        $data['confirmation_code']      = str_random(40);
        $data['order_id']               = ($usr_tbl_id+$i);
        $data['billing_firstname']      = 'N';
        $data['billing_lastname']       = 'C';
        $data['payment_company']        = 'null';
        $data['billing_address']        = 'address12';
        $data['billing_address2']       = 'null';
        $data['billing_city']           = 'null';
        $data['payment_zone_id']        = 'null';
        $data['payment_date']           = '2021-11-05 04:00:32';
        $data['billing_zip']            = 'null';
        $data['payment_zone']           = ($usr_tbl_id+$i);
        $data['payment_zone_code']      = '1234'.($usr_tbl_id+$i);
        $data['billing_country']        = 'US';
        $data['shipping_firstname']     = 'N';
        $data['shipping_lastname']      = 'C';
        $data['shipping_address']       = 'address1';
        $data['shipping_address2']      = 'address2';
        $data['shipping_city']          = 'shipping_city';
        $data['shipping_zip']           = '673301';
        $data['shipping_country']       = 'india';
       
        $data['shipping_state']         = 'kerala';
        $data['package_count']          = 2;
        $data['registration_type']      ='Normal Regisiter';
        $data['tracking_id']            = 'not_found';
        $data['courier_service']        = 'not_found';
        $data['user_type']             = 'Member';

        $messages = [
                'unique' => 'The :attribute already existis in the system',
                'exists' => 'The :attribute not found in the system',

        ];

        $validator = Validator::make($data, [
                'sponsor'          => 'required|exists:users,username|max:255',
                'email'            => 'required|unique:users,email|email|max:255',
                'username'         => 'required|unique:users,username|max:255',
        ]);


            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            $placement_id =  $sponsor_id ;
            if (!$sponsor_id)
            {
             $sponsor_id = 1;
             $placement_id = 1;
            }
        
              $payment   = PendingTransactions::create([
              'order_id' =>($usr_tbl_id+$i),
              'username' =>$sponsor_name.'_'.($usr_tbl_id+$i),
              'email'    =>$sponsor_name.'_'.($usr_tbl_id+$i).'@gmail.com',
              'sponsor'  => $sponsor_id,
              'package'  => 0,
              'request_data'     =>json_encode($data),
              'payment_method'   =>'payment',
              'payment_type'     =>'register',
              'payment_status'   =>'complete',
              'amount'           => 0,
               ]);
            Artisan::call('process:payment', ['--payment_id' =>$payment->id]);

        }
    }     
    DB::commit();
    dd("done");     

    }

     public static function influencercommission($sponsor_id,$user_id,$total_amount,$registration_type)
    {
        // dd(10);
      $bonus   = Settings::find(1);
      $managerbonus=$bonus->influencer_manager;
      $levelbonus=$bonus->influencer_level;
      dd($managerbonus,$levelbonus);
      $influencermanager_bonus=($total_amount * $managerbonus)/100;
      $influencerlevel_bonus=($total_amount * $levelbonus)/100;
      $influencermanager_sponsor_id=InfluencerTree::where('user_id',$sponsor_id)->value('sponsor');
      // if($registration_type == 'Purchase Link')
      // {
      if($sponsor_id != 1 )
      {
      $influencer = PendingCommission::create([
                'user_id'=>$sponsor_id,
                'from_id'=>$user_id,
                'total_amount'=>$influencermanager_bonus,
                'tds'=>$total_amount,
                'service_charge'=>0,
                'payable_amount'=>$influencermanager_bonus,
                'payment_type'=>'influencermanager_bonus',
                'payment_status' => 'no',
                ]);
       // Balance::where('user_id', $sponsor_id)->increment('balance', $influencermanager_bonus);
     }
     // }
      if($influencermanager_sponsor_id != 1 || $influencermanager_sponsor_id != 0)
      {
      $influencermanager = PendingCommission::create([
                'user_id'=>$influencermanager_sponsor_id,
                'from_id'=>$user_id,
                'total_amount'=>$influencerlevel_bonus,
                'tds'=>$total_amount,
                'service_charge'=>0,
                'payable_amount'=>$influencerlevel_bonus,
                'payment_type'=>'influencer_bonus',
                'payment_status' => 'no',
                ]);

      // Balance::where('user_id', $influencermanager_sponsor_id)->increment('balance', $influencerlevel_bonus);
      }
    }
    
}

