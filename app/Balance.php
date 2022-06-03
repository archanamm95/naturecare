<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
      protected $table = 'user_balance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['user_id','balance','register_point'];

      public static function addbalance($user_id)
    {

        self::create([
            'user_id'=>$user_id,
            'balance'=>0,
            'register_point'=>0,
            ]);
    }


    public static function getTotalBalance($user_id)
    {
        return DB::table('user_balance')->where('user_id', $user_id)->value('balance');
    }
    public static function updateBalance($user_id, $amount)
    {
        $total_balance = self::getTotalBalance($user_id);
        $update_amount = $total_balance - $amount;
        DB::table('user_balance')
            ->where('user_id', $user_id)
            ->update(['balance' => $update_amount]);
    }
}
