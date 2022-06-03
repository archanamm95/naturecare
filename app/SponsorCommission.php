<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SponsorCommission extends Model
{
    use SoftDeletes;

    protected $table = 'sponsor_commission';

    protected $fillable = ['type','criteria','sponsor_commission'];

    public static function XsponsorCommission($user_id, $package, $sponsor)
    {
        $sponpackage=ProfileInfo::where('user_id', $sponsor)->value('package');
        $sponsorpack=Packages::find($sponpackage)->amount;
        $userpack=Packages::find($package)->amount;
        $sponsor_settings=self::find(1);
        if ($sponsor_settings->type == 'fixed' &&
                $sponsor_settings->criteria == 'yes') {
             echo "1\n";
            $amount=LevelSettingsTable::where('package', $package)->value('sponsor_comm');
        }
        if ($sponsor_settings->type == 'fixed' &&
                $sponsor_settings->criteria == 'no') {
             echo "2\n";
             $amount=$sponsor_settings->sponsor_commission;
        }
        if ($sponsor_settings->type == 'percent' && $sponsor_settings->criteria == 'yes') {
             echo "3\n";
             $am=LevelSettingsTable::where('package', $package)->value('sponsor_comm');
             $amount=$am*$userpack*0.01;
        }
        if ($sponsor_settings->type == 'percent' && $sponsor_settings->criteria == 'no') {
             echo "4\n";
            $amount=$sponsor_settings->sponsor_commission*$sponsorpack*0.01;
        }
             echo "comm=".$amount."\n";
        
            $commision = Commission::create([
                'user_id'        => $sponsor,
                'from_id'        => $user_id,
                'total_amount'   => $amount,
                'tds'            => 0,
                'service_charge' => 0,
                'payable_amount' => $amount,
                'payment_type'   => 'sponsor_commission',
                'payment_status' => 'Yes',
            ]);
            User::upadteUserBalance($sponsor, $amount);
    }
    public static function sponsorCommission($user_id, $bv, $sponsor)
    {
            $percent = SELF::find(1)->sponsor_commission;
            $amount = ($bv*$percent)/100;
        
            $commision = Commission::create([
                'user_id'        => $sponsor,
                'from_id'        => $user_id,
                'total_amount'   => $amount,
                'tds'            => $percent,
                'service_charge' => $bv,
                'payable_amount' => $amount,
                'payment_type'   => 'sponsor_commission',
                'payment_status' => 'Yes',
            ]);
            User::upadteUserBalance($sponsor, $amount);
    }
}
