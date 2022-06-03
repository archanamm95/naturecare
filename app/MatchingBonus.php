<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchingBonus extends Model
{
    //
    use SoftDeletes;


    protected $table = 'matching_bonus' ;


    protected $fillable = ['type','criteria','matching_level1','matching_level2','matching_level3'] ;

    public static function matchingBonusCalc($user, $pairamount)
    {
        $package=ProfileInfo::where('user_id', $user)->value('package');
        $user_arrs=[];
        $match_users=LevelCommissionSettings::getthreeupllins($user, 1, $user_arrs);
        $matching_bonus=self::find(1);
        foreach ($match_users as $key => $match_user) {
            $packkey=$key+1;
            $mlevel='matching_level'.$packkey;
            $mlev=self::value($mlevel);
            if ($matching_bonus->type == 'fixed' &&
                $matching_bonus->criteria == 'yes') {
                $amount=LevelSettingsTable::where('package', $package)->value('matching_level'.$packkey);
            }
            if ($matching_bonus->type == 'fixed' &&
                $matching_bonus->criteria == 'no') {
                 $amount=$mlev;
            }
            if ($matching_bonus->type == 'percent' && $matching_bonus->criteria == 'yes') {
                 $am=LevelSettingsTable::where('package', $package)->value('matching_level'.$packkey);
                 $amount=$am*$pairamount*0.01;
            }
            if ($matching_bonus->type == 'percent' && $matching_bonus->criteria == 'no') {
                $amount=$mlev*$pairamount*0.01;
            }

            $commision = Commission::create([
                'user_id'        => $match_user,
                'from_id'        => $user,
                'total_amount'   => $amount,
                'tds'            => 0,
                'service_charge' => 0,
                'payable_amount' => $amount,
                'payment_type'   => 'level_'.$packkey.'_matchingbonus',
                'payment_status' => 'Yes',
            ]);
         
            User::upadteUserBalance($match_user, $amount);
        }
    }
}
