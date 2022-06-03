<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PurchaseHistory;
use App\Commission;
use App\User;
use App\Settings;
use App\SponsorChangeHistory;
use App\PendingCommission;
use App\Sponsortree;
use App\StockManagement;
use App\UsertypeHistory;


class Commission extends Model
{
     

    use SoftDeletes;

    protected $table = 'commission';

    protected $fillable = ['user_id', 'from_id','total_amount','tds','service_charge','payable_amount','payment_type','payment_status','note'];

    //svf-start


    public static function salesBonus($user_id,$from_id,$pckg_count)
   {
        // $data = PurchaseHistory::where('id',$purchaseID)->first();
        // $user_id = $data->user_id;
        
        // $sponsor_id = Sponsortree::where('user_id',$user_id)->value('sponsor');

        $next_bonus = User::where('id',$user_id)->value('next_bonus');
        $settings = Settings::first();

        $amount = 0;
        $flag   = $next_bonus;

        for ($i=0; $i < $pckg_count; $i++) { 

                $bonus = "bonus_".$flag;
                $value = $settings->$bonus;
                $amount = $amount + $value;

                if ($flag == 1) 
                    $flag = 2;
                else
                    $flag =1; 
        }

        User::where('id',$user_id)->update(['next_bonus'=>$flag]);
        
        // if (isset($amount)) {
             PendingCommission::create([
                'user_id'=>$user_id,
                'from_id'=>$from_id,
                'total_amount'=>$amount,
                'tds'=>$pckg_count,
                'service_charge'=>$next_bonus,//store next_bonus. starting value
                'payable_amount'=>$amount,
                'payment_type'=>'sales_bonus',
                ]);
        // }

    }
    public static function changeSponsor($old_sponsor,$new_sponsor)
    {
      $referals = Sponsortree::where('sponsor',$old_sponsor)->pluck('user_id');
      
      Sponsortree::whereIn('user_id',$referals)->update(['sponsor' => $new_sponsor]);

      SponsorChangeHistory::create([
            'new_sponsor'     =>  $new_sponsor,  
            'old_sponsor'     =>  $old_sponsor,
            'referals'        =>  json_encode($referals),
      ]);

    }

    public static function referalBonus($sponsor_id,$user_id)
    {
      $amount = Settings::where('id',1)->value('sponsor_Commisions');

      PendingCommission::create([
                'user_id'=>$sponsor_id,
                'from_id'=>$user_id,
                'total_amount'=>$amount,
                'tds'=>$amount,
                'service_charge'=>0,
                'payable_amount'=>$amount,
                'payment_type'=>'referral_bonus',
                //payment_status will be "no" by default
                ]);
    }

    public static function levelBonus($user_id,$sponsor,$count,$lev_settings,$level = 1)
    {
      // $lev_settings = LevelCommissionSettings::first();
      $result = self::levelCriteria($sponsor,$level,$lev_settings);

      if (isset($result)) {

          $bonus_lev = "level_".$level;
          $amount = $lev_settings->$bonus_lev * $count;

          PendingCommission::create([
                    'user_id'=>$sponsor,
                    'from_id'=>$user_id,
                    'total_amount'=>$amount,
                    'tds'=>$amount,
                    'service_charge'=>0,
                    'payable_amount'=>$amount,
                    'payment_type'=>'level_'.$level.'_bonus',
                    //payment_status will be "no" by default
                    ]);
       }


      if ($level < 3 && $sponsor != 1) {
          $sponsor = Sponsortree::where('user_id',$sponsor)->value('sponsor');
          self::levelBonus($user_id,$sponsor,$count,$lev_settings,++$level);
      }

    }
    public static function levelBonusNew($user_id,$from_id,$lev_settings,$level = 1)
    {
        $total_sale = PurchaseHistory::where('seller_id',$user_id)->sum('total_amount');
        $result = self::levelCriteriaNew($user_id,$total_sale,$lev_settings,$level);

        if ($result > 0) {
            PendingCommission::create([
                    'user_id'=>$user_id,
                    'from_id'=>$from_id,
                    'total_amount'=>$result,
                    'tds'=>$result,
                    'service_charge'=>0,
                    'payable_amount'=>$result,
                    'payment_type'=>'level_'.$level.'_bonus',
                    //payment_status will be "no" by default
            ]);
        }

        if ($level <= 3)
            self::levelBonusNew($user_id,$from_id,$lev_settings,++$level);

    }

    public static function leadershipBonus($seller)
    {
       
     $sponsor_id=User::where('id',$seller)->value('sponsor_id');
    $refferal_id= Sponsortree::where('sponsor', $sponsor_id)
                ->join('users', 'users.id','sponsortree.user_id')
                ->where('sponsortree.type', '!=', 'vaccant')
                ->where('users.is_usedto_leader','=',0)
                ->pluck('users.id')->toArray();
                
    $count=count($refferal_id);
               
                
    if ($count % 10 == 0) {
        $amount = Settings::where('id',1)->value('service_charge');

        PendingCommission::create([
                'user_id'=>$sponsor_id,
                'from_id'=>1,//from user as admin
                'total_amount'=>$amount,
                'tds'=>$amount,
                'service_charge'=>0,
                'payable_amount'=>$amount,
                'payment_type'=>'leadership_bonus',
                //payment_status will be "no" by default
        ]);

     
        User::whereIn('id',$refferal_id)->update(['is_usedto_leader'=>1]);
    }

    }

    public static function levelCriteriaNew($user_id,$amount,$settings,$level)
    {
        $bonus = 0;
        $referals = Sponsortree::where('sponsor',$user_id)->where('type','yes')->pluck('user_id')->toArray();
        $criteria = 'criteria_l'.$level;

        if ($level >= 2 ) {
            $referals = Sponsortree::whereIn('sponsor',$referals)->pluck('user_id')->toArray();
            if ($level == 3)
                $referals = Sponsortree::whereIn('sponsor',$referals)->pluck('user_id')->toArray();
        }

        if (count($referals) > 0 && $amount >= $settings->$criteria) {


            $level_sales = PurchaseHistory::whereIn('seller_id',$referals)->sum('total_amount');
            $bonus_lev  = "level_".$level;
            $bonus      = ($level_sales* $settings->$bonus_lev)/ 100;

            if ($level == 3) {
                if ($level_sales < $settings->criteria2_l3)
                    $bonus = 0; // reset back to zero
            }
            
        }
        return $bonus;
       
    }
    public static function levelCriteria($user_id,$level,$settings)
    {
        $crnt_mnth_sale = PurchaseHistory::where('seller_id',$user_id)
            ->whereYear('created_at',date('Y'))
            ->whereMonth('created_at',date('m',strtotime('-0 months')))
            ->sum('total_amount');

        $criteria = 'criteria_l'.$level;

        if ($crnt_mnth_sale >= $settings->$criteria) {

            if ($level == 3) {//second condition for 3rd level only

              $referals = Sponsortree::where('sponsor',$user_id)->pluck('user_id');

              $ref_crnt_mnth_sale = PurchaseHistory::where('seller_id',$referals)
              ->whereYear('created_at',date('Y'))
              ->whereMonth('created_at',date('m',strtotime('-0 months')))//last month 
              ->sum('count');

                if ($ref_crnt_mnth_sale < $settings->criteria2_l3) {
                    return false;
                }
            }
            return true;
        }  
        else
        {
            return false;
        }
    }

    public static function userstatuUpgrade($seller,$user_id,$registration_type,$pckg_count,$user_type)
    {

        $settings   = Settings::find(1);
        $seller_current_type=User::where('id',$seller)->value('user_type');
        $user_current_type=User::where('id',$user_id)->value('user_type');
        $user_sale_count= PurchaseHistory::where('seller_id',$seller)
            ->where('type','Packages')
              // ->whereYear('created_at',date('Y'))
              // ->whereMonth('created_at',date('m',strtotime('-0 months')))//last month 
        //need to set as 4 months duration
              ->sum('count');

        // $purchase_count = PurchaseHistory::where('user_id',$user_id)
        //     ->where('type','Packages')           
        //       ->sum('count');
        if ($registration_type != 'Purchase Link') {
            if ($user_current_type != 'Share Partner' && $pckg_count >= $settings->member_condition)
            {

               
                User::where('id',$user_id)->update(['user_type' => 'Member']);
            }
             // $usertypehistory = UsertypeHistory::create([
                // 'user_id'              => $user_id,
                // 'user_type'            => 'Member',
                
                //  ]); 
        }

        if ($seller_current_type != 'Share Partner' && $user_sale_count >= $settings->dealer_condition) {
           
            User::where('id',$seller)->update(['user_type' => 'Dealer','is_usedto_leader' => 0]);
            Commission::leadershipBonus($seller);
             // $usertypehistory = UsertypeHistory::create([
            //     'user_id'              => $seller,
            //     'user_type'            => 'Dealer',
                
            //      ]);   
           
        }

         if ($user_type == 'Share Partner') {
            
            User::where('id',$user_id)->update(['user_type' => 'Share Partner']);
            StockManagement::sharePartner_Order($user_id);
            // $usertypehistory = UsertypeHistory::create([
            //     'user_id'              => $user_id,
            //     'user_type'            => 'Share Partner',
                
            //      ]);   
        }
    }

    //svf-end

    //new plan updation(14-03-2022) -fvs- start

    public static function userstatuUpgradeNew($value)
    {
        $seller             = $value['seller'];
        $user_id            = $value['user_id'];
        $registration_type  = $value['registration_type'];
        $amount             = $value['amount'];
        $user_type          = $value['user_type'];
        $settings           = $value['settings'];
        // $settings   = Settings::find(1);
        $seller_current_type =User::where('id',$seller)->value('user_type');
        $user_current_type   =User::where('id',$user_id)->value('user_type');
        $user_sales          = PurchaseHistory::where('seller_id',$seller)
              ->whereYear('created_at',date('Y'))
              // ->whereMonth('created_at',date('m',strtotime('-3 months')))// need to take 4 months data??? //commented by archana
              ->whereBetween('created_at',[date('Y-m-d H:i:s', strtotime('-3 months')),date('Y-m-d H:i:s')]) //added by archana
              ->sum('total_amount');
        $flag = 0;

        if ($registration_type != 'Purchase Link') {
            if ($user_current_type != 'Share Partner' && $amount >= $settings->member_condition)
            {
                User::where('id',$user_id)->update(['user_type' => 'Member']);
            }
            $flag       = 1;
            $user_type  = 'Member';
        }

        if ($seller_current_type != 'Share Partner' && $user_sales >= $settings->dealer_condition) {
            User::where('id',$seller)->update(['user_type' => 'Dealer','is_usedto_leader' => 0]);
            Commission::leadershipBonus($seller);
            $flag       = 1;
            $user_type  = 'Dealer';
        }

        // if ($user_type == 'Share Partner') { //commented by archana
        if ($user_sales >= $settings->share_partner_condition) { //added by archana
            User::where('id',$seller)->update(['user_type' => 'Share Partner']);
            StockManagement::sharePartner_Order($user_id);
            $flag       = 1;
            $user_type  = 'Share Partner';
        }
        if ($flag == 1) {
            $usertypehistory = UsertypeHistory::create([
                'user_id'              => $user_id,
                'user_type'            => $user_type,
            ]);   
        }
    }

    public static function personalSalesBonus($user_id,$from_id,$amount,$percent)
    {

        $bonus = ($amount * $percent)/100 ;
        PendingCommission::create([
                'user_id'=>$user_id,
                'from_id'=>$from_id,
                'total_amount'=>$bonus,
                'tds'=>$bonus,
                'service_charge'=>0,
                'payable_amount'=>$bonus,
                'payment_type'=>'personal_sales_bonus',
                //payment_status will be "no" by default
                ]);

    }

    //new plan updation -fvs - end

    public function sponsorcommission($sponsor_id, $from_id)
    {

         $settings = Settings::getSettings();

         $sponsor_commisions = $settings[0]->sponsor_Commisions;

         $tds = $sponsor_commisions * $settings[0]->tds / 100;
         /**
         * calcuate service charge
         * @var [type]
         */
         $service_charge = $sponsor_commisions * $settings[0]->service_charge / 100;
         /**
         * Calculates payable amount
         * @var [type]
         */
         $payable_amount = $sponsor_commisions - $tds - $service_charge;
         /**
         * Creates entry for user in commission table and set payment status to yes
         * @var [type]
         */
         $commision = self::create([
                'user_id'        => $sponsor_id,
                'from_id'        => $from_id,
                'total_amount'   => $sponsor_commisions,
                'tds'            => $tds,
                'service_charge' => $service_charge,
                'payable_amount' => $payable_amount,
                'payment_type'   => 'sponsor_commission',
                'payment_status' => 'Yes',
                
          ]);
          /**
          * updates the userbalance
          */
          User::upadteUserBalance($sponsor_id, $payable_amount);
    }
    public static function binaryCommission($from_id, $placement_id, $total_amount, $amount_payable, $tds, $service_charge)
    {
        
         $res = self::create([
                'user_id'=>$placement_id,
                'from_id'=>$from_id,
                'total_amount'=>$total_amount,
                'tds'=>$tds,
                'service_charge'=>$service_charge,
                'payable_amount'=>$amount_payable,
                'payment_type'=>'binary',
                ]);
        
         $user_type = self::checkUserType($placement_id);
        if ($user_type == "user") {
            self::updateUserBalance($placement_id, $amount_payable);
            $placement_id = self::getUplineId($placement_id);
            self::binaryCommission($from_id, $placement_id, $total_amount, $amount_payable, $tds, $service_charge);
        }
    }

    public static function getUplineId($user_id)
    {
         return DB::table('tree_table')->where('user_id', $user_id)->pluck('placement_id');
    }

   
    public static function updateUserBalance($user_id, $amount)
    {

        return    Balance::where('user_id', $user_id)->increment('balance', $amount);
    }

    public static function binaryLimit($user_id, $package_id)
    {
        $daily_limit = Packages::where('id', '=', $package_id)->value('daily_limit');
        $today = date('Y-m-d 00:00:00');
        $end_date=date('Y-m-d 24:59:59');
        $total_binary = Commission::where('user_id', $user_id)->where('created_at', '>=', $today)->where('created_at', '<=', $end_date)->Where('payment_type', 'binary_bonus')->sum('payable_amount');
        if ($total_binary <= $daily_limit) {
            $balance = $daily_limit - $total_binary;
            return $balance;
        } else {
            return 0;
        }
    }
    public static function sponsor_commission($sponsor, $user, $pv)
    {
        $sponsor_amount = SponsorCommission::find(1)->sponsor_commission;
        $total_amount =$pv*$sponsor_amount*.01;
        if ($total_amount > 0) {
            $commision = self::create([
                  'user_id'        => $sponsor,
                  'from_id'        => $user,
                  'total_amount'   => $total_amount,
                  'tds'            => $pv,
                  'service_charge' => '0',
                  'payable_amount' => $total_amount,
                  'payment_type'   => 'sponsor_commission',
                  'payment_status' => 'Yes',
            ]);
            Balance::where('user_id', $sponsor)->increment('balance', $total_amount);
        }
    }
     public static function influencercommission($seller_id,$user_id,$total_amount)
    {

      $bonus   = Settings::find(1);
      $managerbonus=$bonus->influencer_manager;
      $levelbonus=$bonus->influencer_level;
      $influencermanager_bonus=($total_amount * $managerbonus)/100;
      $influencerlevel_bonus=($total_amount * $levelbonus)/100;
      $influencermanager_sponsor_id=InfluencerTree::where('user_id',$seller_id)->value('sponsor');
      // if($registration_type == 'Purchase Link')
      // {

      if($seller_id != 1 )
      {
      
      $influencer = Commission::create([
                'user_id'=>$seller_id,
                'from_id'=>$user_id,
                'total_amount'=>$influencermanager_bonus,
                'tds'=>$total_amount,
                'service_charge'=>0,
                'payable_amount'=>$influencermanager_bonus,
                'payment_type'=>'influencermanager_bonus',
                'payment_status' => 'yes',
                ]);
        Balance::where('user_id', $seller_id)->increment('balance', $influencermanager_bonus);
        Payout::create([
                    'user_id'        => $seller_id,
                    'amount'         => $influencermanager_bonus,
                    'payment_mode'   => 1,//'Mnaual/Bank'
                    'status'         => 'pending'
                ]);
     }
     // }
      if($influencermanager_sponsor_id > 1 )
      {
      
      $influencermanager = Commission::create([
                'user_id'=>$influencermanager_sponsor_id,
                'from_id'=>$user_id,
                'total_amount'=>$influencerlevel_bonus,
                'tds'=>$total_amount,
                'service_charge'=>0,
                'payable_amount'=>$influencerlevel_bonus,
                'payment_type'=>'influencer_level1_bonus',
                'payment_status' => 'yes',
                ]);

       Balance::where('user_id', $influencermanager_sponsor_id)->increment('balance', $influencerlevel_bonus);
       Payout::create([
                    'user_id'        => $influencermanager_sponsor_id,
                    'amount'         => $influencerlevel_bonus,
                    'payment_mode'   => 1,//'Mnaual/Bank'
                    'status'         => 'pending'
                ]);
      }
    }

}