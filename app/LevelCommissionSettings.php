<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelCommissionSettings extends Model
{
    use SoftDeletes;

    protected $table = 'level_commission_settings';

    protected $fillable = ['type','criteria','nlevel_1','nlevel_2','nlevel3'];

    public static function levelCommission($user_id, $package)
    {
         $user_arrs=[];
         $users=self::getthreeupllins($user_id, 1, $user_arrs);
         $level_settings=self::find(1);
         $userpack_info=Packages::find($package);
        foreach ($users as $key => $user) {
            // echo "user".$user."<br>";
            $sponpackage=ProfileInfo::where('user_id', $user)->value('package');
            $pack_info=Packages::find($sponpackage);
            $packkey=$key+1;
            $nlevel='nlevel_'.$packkey;
            $nlev=self::value($nlevel);
            if ($level_settings->type == 'fixed' &&
               $level_settings->criteria == 'yes') {
                // echo "1<br>";
                $amount=LevelSettingsTable::where('package', $package)->value('commission_level'.$packkey);
            }
            if ($level_settings->type == 'fixed' &&
               $level_settings->criteria == 'no') {
                 // echo "2br>";
                $amount=$nlev;
            }
            if ($level_settings->type == 'percent' && $level_settings->criteria == 'yes') {
                 // echo "3<br>";
                $am=LevelSettingsTable::where('package', $package)->value('commission_level'.$packkey);

                  // echo "packkey".$packkey."<br>";
                  //  echo "am".$am."<br>";
                $amount=$am*$userpack_info->amount*0.01;
            }
            if ($level_settings->type == 'percent' && $level_settings->criteria == 'no') {
                 // echo "4<br>";
                $amount=$nlev*$pack_info->amount*0.01;
            }
                  // echo "nlev".$nlev."<br>";

                 // echo "amount".$amount."<br>";


                $commision = Commission::create([
                   'user_id'        => $user,
                   'from_id'        => $user_id,
                   'total_amount'   => $amount,
                   'tds'            => 0,
                   'service_charge' => 0,
                   'payable_amount' => $amount,
                   'payment_type'   => 'level_'.$packkey.'_commission',
                   'payment_status' => 'Yes',
                ]);
              User::upadteUserBalance($user, $amount);
        }
    }


    public static function getthreeupllins($upline_users, $level = 1, $uplines)
    {
        if ($level > 3) {
            return $uplines;
        }
        $upline=Sponsortree::join('users', 'users.id', '=', 'sponsortree.sponsor')->where('user_id', $upline_users)->where('sponsortree.type', '=', 'yes')->value('sponsor');
        if ($upline > 0) {
            $uplines[]=$upline;
        }

        if ($upline == 1) {
            return $uplines;
        }
       
        return self::getthreeupllins($upline, ++$level, $uplines);
    }
    
}
