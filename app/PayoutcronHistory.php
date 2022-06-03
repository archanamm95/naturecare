<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayoutcronHistory extends Model
{
    
     protected $table = 'payout_history';

    protected $fillable = ['user_id','payment_mode', 'receiver_address','amount','response'];
}
