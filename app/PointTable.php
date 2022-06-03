<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Sponsortree;
use App\PointHistory;

class PointTable extends Model
{


    // use softDeletes;
    protected $table = 'point_table';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','pv','redeem_pv','right_carry','left_carry','total_left','total_right','right_user','left_user','left_puser','right_puser'];


    public function userR()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }



    public static function addPointTable($user_id)
    {

        self::create([
            'user_id'=>$user_id,
            'redeem_pv'=>0,
            'pv'=>0,
            ]);
    }

   

    public static function getUserPoint($user_id)
    {

        return self::where('user_id', $user_id)->get();
    }


    public static function updatePoint($bv_update, $from_id)
    {
        Sponsortree::$upline_users =[];
        Sponsortree::getAllUpline($from_id);
        $upline_users = Sponsortree::$upline_users;
      

        foreach ($upline_users as $key => $value) 
        {
        
            if ($value['user_id'] > 0) {
                self::where('user_id', $value['user_id'])->increment('pv', $bv_update);
       
                PointHistory::addPointHistoryTable($value['user_id'], $from_id, $bv_update, 'L','purchase');
            }
          
             
        }
     
    }
    public static function pairing($user_id=0,$from_id=0)
    {
      
        // $users_list = self::where('point_table.left_carry', '>', 0)
        //              ->where('point_table.right_carry', '>', 0)
        //              ->where('point_table.user_id', $user_id)
        //              ->select('point_table.*')
        //              ->get();
        $value = PointTable::where('user_id',$user_id)->first();

        if($value->left_carry > 0 && $value->right_carry > 0){

            $pv_pair = min($value->left_carry, $value->right_carry);

            $binarysettings = BinaryCommissionSettings::find(1);

            $total_amount =   $pv_pair * $binarysettings->pair_value /100 ;
            if($binarysettings->binary_cap == 'yes'){
                $total_binary = Commission::where('user_id',$user_id)
                                ->where('payment_type','binary_bonus')
                                ->where('created_at', '>', date('Y-m-d 00:00:00'))
                                ->where('created_at', '<', date('Y-m-d 23:59:59'))
                                ->sum('total_amount');

                $userpack = ProfileInfo::where('user_id',$user_id)->value('package')+1;

                if($userpack > 1){
                   $caplimit = "pack_".$userpack;
                   $grandtotal = $total_binary + $total_amount;

                   if($grandtotal > $binarysettings->$caplimit)
                        $total_amount = $binarysettings->$caplimit - $total_binary;
                }
                else
                   $total_amount = 0;

                if($total_amount > 0){                    
                    Commission::create([
                       'user_id'=>$user_id,
                       'from_id'=>$from_id,
                       'total_amount'=>$total_amount,
                       'tds'=>0,
                       'service_charge'=>0,
                       'payable_amount'=>$total_amount,
                       'payment_type'=>'binary_bonus',
                       ]);
                    Balance::where('user_id', $user_id)->increment('balance', $total_amount);
                }      
                self::where('user_id', '=', $user_id)->decrement('left_carry', $pv_pair);
                self::where('user_id', '=', $user_id)->decrement('right_carry', $pv_pair);
            }
            else{
              if($total_amount > 0){
                  
                  Commission::create([
                     'user_id'=>$user_id,
                     'from_id'=>$from_id,
                     'total_amount'=>$total_amount,
                     'tds'=>0,
                     'service_charge'=>0,
                     'payable_amount'=>$total_amount,
                     'payment_type'=>'binary_bonus',
                     ]);
                  Balance::where('user_id', $user_id)->increment('balance', $total_amount);
                         
                  self::where('user_id', '=', $user_id)->decrement('left_carry', $pv_pair);
                  self::where('user_id', '=', $user_id)->decrement('right_carry', $pv_pair);
              }
            }

            // self::matchingbonus($value->user_id, $value->user_id, $total_amount);
        }
    }
    public static function pairing1()
    {
      
        $users_list = self::where('point_table.left_carry', '>', 0)
                     ->where('point_table.right_carry', '>', 0)
                     ->select('point_table.*')
                     ->get();

        foreach ($users_list as $key => $value) {
            echo " ------------ " ;
            $pv_pair = min($value->left_carry, $value->right_carry);
            $total_amount =   $pv_pair * 10 /100 ;
            Commission::create([
               'user_id'=>$value->user_id,
               'from_id'=>$value->user_id,
               'total_amount'=>$total_amount,
               'tds'=>0,
               'service_charge'=>0,
               'payable_amount'=>$total_amount,
               'payment_type'=>'binary_bonus',
               ]);
            Balance::where('user_id', $value->user_id)->increment('balance', $total_amount);
                   
            self::where('user_id', '=', $value->user_id)->decrement('left_carry', $pv_pair);
            self::where('user_id', '=', $value->user_id)->decrement('right_carry', $pv_pair);

            self::matchingbonus($value->user_id, $value->user_id, $total_amount);
        }
    }


    public static function matchingbonus($from_id, $user_id, $amount, $level = 0)
    {

        $level_bonus = [5,3,2] ;
        $bonus_percent = $level_bonus[$level] ;//self::where('package_id',$package_id)->value("$column");
         $sponsor_id = Sponsortree::where('user_id', $user_id)->value('sponsor');
        if ($bonus_percent) {
              $total_amount = $amount * $bonus_percent / 100 ;

               $settings = Settings::getSettings();
               // $sponsor_commisions =7;// $settings[0]->sponsor_Commisions;
               $tds = $total_amount * $settings[0]->tds / 100;
               $service_charge = $total_amount * $settings[0]->service_charge / 100;
               $payable_amount = $total_amount - $tds - $service_charge;

              Commission::create([
                      'user_id'=>$sponsor_id,
                      'from_id'=>$from_id,
                      'total_amount'=>$total_amount ,
                      'tds'            => $tds,
                      'service_charge' => $service_charge,
                      'payable_amount'=>$payable_amount ,
                      'payment_type'=>'matching_bonus',
                      ]);
              Balance::where('user_id', $user_id)->increment('balance', $payable_amount);
               

            if ($level <= 1 && $sponsor_id > 0) {
                return self::matchingbonus($from_id, $sponsor_id, $amount, ++$level);
            }
        }
            return ;
    }

    public static function binaryQualification($user_id)
    {
        $left_count = Sponsortree::where('user_id', $user_id)->value('sponsor');
        if ($left_count > 0|| $user_id==1) {
            return "yes";
        } else {
            return "no";
        }
    }

    public static function binary($from_id, $sponsor)
    {
        $point_left=PointTable::where('user_id', $sponsor)->value('left_carry');
        $point_right=PointTable::where('user_id', $sponsor)->value('right_carry');
        if ($point_left>0 && $point_right>0) {
            $sponsor_package = ProfileInfo::where('user_id', '=', $sponsor)->value('package');
            $pairing_bonus=Packages::where('id', '=', $sponsor_package)->value('code');
            $pv_pair=min($point_left, $point_right);
            $total_commission=$pairing_bonus*$pv_pair*0.01;
             // dd($sponsor_package);
            $balance = Commission::binaryLimit($sponsor, $sponsor_package);
            // dd($balance);
            if ($total_commission >= $balance) {
                $total_amount = $balance;
            } elseif ($total_commission < $balance) {
                $total_amount = $total_commission;
            }
            if ($total_amount>0) {
                $tds=$service_charge=0;
                Commission::create([
                        'user_id'=>$sponsor,
                        'from_id'=>$from_id,
                        'total_amount'=>$total_amount ,
                        'tds'            => $tds,
                        'service_charge' => $service_charge,
                        'payable_amount'=>$total_amount ,
                        'payment_type'=>'binary_bonus',
                        ]);
                Balance::where('user_id', $sponsor)->increment('balance', $total_amount);
            }

            $left_carry = $point_left -$pv_pair;
            $right_carry =$point_right-$pv_pair;
            PointTable::where('user_id', $sponsor)->update(['left_carry'=>$left_carry,
            'right_carry'=>$right_carry]);
        }
    }
    public static function updaterank($user_id)
    {
        Tree_Table::$upline_users = [];
        Tree_Table::getAllUpline($user_id);
        $user_uplines=Tree_Table::$upline_users;
        foreach ($user_uplines as $key => $value) {
            $downline = array();
            Tree_Table::$downline = [];
            Tree_Table::getDownlineuser(true, $value['user_id']);
            $downline_count = count(Tree_Table::$downline);
            $userrank = User::where('id', $value['user_id'])->value('rank_id');
            $new_rank = Ranksetting::where('top_up', '<=', $downline_count)->max('id');
            if ($userrank < $new_rank) {
                $today = date('Y-m-d H:i:s');
                User::where('id', $value['user_id'])->update(['rank_id'=>$new_rank , 'rank_update_date'=>$today]);
                $remark = Ranksetting::where('id', $new_rank)->value('rank_bonus');
                Rankhistory::create([
                        'user_id'=>$value['user_id'],
                        'rank_id'=>$userrank,
                        'rank_updated'=>$new_rank ,
                        'remarks'      => $remark,
                        ]);
            }
        }
    }
}
