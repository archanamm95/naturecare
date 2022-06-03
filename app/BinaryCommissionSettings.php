<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BinaryCommissionSettings extends Model
{
    use SoftDeletes;

    protected $table = 'binary_commission_settings';

    protected $fillable = ['period','type','pair_value','pack_2','pack_4','binary_cap','pack_3','monthly_maintenance'];

    public static function BinaryCommsion($binary, $user, $period)
    {

        $pac=ProfileInfo::where('user_id', $user->user_id)->value('package');
        $package=$pac-1;
        $pair_commission=json_decode($binary->pair_commission);
        $pair_commission_percent=json_decode($binary->pair_commission_percent);


        if ($binary->binary_cap == 'yes') {
            if ($period == 1) {
                $limit=Commission::where('user_id', $user->user_id)
                                 ->where('created_at', date('Y-m-d H:i:s'))
                                 ->where('payment_type', 'NOT LIKE', 'fund%')
                                 ->sum('total_amount');
            }
            if ($period == 2) {
                $limit=Commission::where('user_id', $user->user_id)
                                 ->where('created_at', '>', date('Y-m-d 00:00:00'))
                                  ->where('created_at', '<', date('Y-m-d 23:59:59'))
                                 ->where('payment_type', 'NOT LIKE', 'fund%')
                                 ->sum('total_amount');
            }
            if ($period == 3) {
                $date=date('Y-m-d 23:59:59');
                $week_date= date('Y-m-d 00:00:00', (strtotime('-6 day', strtotime($date))));
                $limit=Commission::where('user_id', $user->user_id)
                                 ->where('created_at', '>', $week_date)
                                  ->where('created_at', '<', $date)
                                 ->where('payment_type', 'NOT LIKE', 'fund%')
                                 ->sum('total_amount');
            }

            if ($period == 4) {
                $date=date('m/d/Y');
                $limit=Commission::where('user_id', $user->user_id)
                              ->whereYear('created_at', '=', date('Y', strtotime($date)))
                                 ->whereMonth('created_at', '=', date('m', strtotime($date)))
                                 ->where('payment_type', 'NOT LIKE', 'fund%')
                                 ->sum('total_amount');
            }

            if ($period == 5) {
                if (date('Y-m-d') == date('Y-m-15')) {
                    $limit=Commission::where('user_id', $user->user_id)
                                 ->where('created_at', '>', date('Y-m-d 00:00:00'))
                                 ->where('created_at', '<', date('Y-m-15 23:59:59'))
                                 ->where('payment_type', 'NOT LIKE', 'fund%')
                                 ->sum('total_amount');
                } else {
                    $limit=Commission::where('user_id', $user->user_id)
                                 ->where('created_at', '>', date('Y-m-16 00:00:00'))
                                  ->where('created_at', '<', date('Y-m-30 23:59:59'))
                                 ->where('payment_type', 'NOT LIKE', 'fund%')
                                 ->sum('total_amount');
                }
            }
        }



        $minimum=min($user->left_carry, $user->right_carry);
        echo "minimum=".$minimum."\n";
        if ($binary->type == 'fixed') {
            $amt=$minimum/$binary->pair_value;
            echo "amt".$amt."\n";
            $pair_amount=$pair_commission[$package]*$amt;

            echo "pac".$pair_commission[$package]."<br>";
            echo "pair_amount".$pair_amount."<br>";


            // dd("yes");
        } else {
            $pair_amount=$pair_commission_percent[$package]*$minimum*0.01;
              echo "package=".$pair_commission_percent[$package]."\n";
        }
        echo "Commission=".$pair_amount."\n";

        if ($binary->binary_cap == 'yes') {
            $sum_amount=$limit+$pair_amount;
            if ($sum_amount <= $binary->ceiling) {
                 echo "yes_less\n";
                self::CommissionEntry($user->user_id, 1, $pair_amount, 'binary_bonus', $user->left_carry, $user->right_carry, $binary->pair_value);
            }

              // else{
              //   $comm_amount=$binary->ceiling-$limit;
              //    self::CommissionEntry($user->user_id,1,$comm_amount,'binary_bonus',$user->left_carry,$user->right_carry,$binary->pair_value);

              // }
        }
        if ($binary->binary_cap == 'no') {
             echo "no_cap\n";
              // echo "total_Commission=".$limit."\n";

            self::CommissionEntry($user->user_id, 1, $pair_amount, 'binary_bonus', $user->left_carry, $user->right_carry, $binary->pair_value);
        }
        echo "**************************\n";
    }




    public static function CommissionEntry($user, $from, $amount, $pay_type, $leftcarry, $rightcarry, $pair)
    {

        $commision = Commission::create([
                    'user_id'        => $user,
                    'from_id'        => $from,
                    'total_amount'   => $amount,
                    'tds'            => 0,
                    'service_charge' => 0,
                    'payable_amount' => $amount,
                    'payment_type'   => $pay_type,
                    'payment_status' => 'Yes',
                ]);

        $binary_settings=self::find(1);
        if ($binary_settings->type == 'fixed') {
            $left=$leftcarry-$pair;
            $right=$rightcarry-$pair;
        } else {
            $min=  min($leftcarry, $rightcarry);
            $left=$leftcarry-$min;
            $right=$rightcarry-$min;
        }

        User::upadteUserBalance($user, $amount);
        PointTable::where('user_id', $user)->update(['left_carry' => $left, 'right_carry' => $right]);
        MatchingBonus::matchingBonusCalc($user, $amount);
    }
}
