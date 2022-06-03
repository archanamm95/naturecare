<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payout_gateway_details extends Model
{
     protected $table = 'payout_gateway_details';

    protected $fillable = ['paypal_clientId', 'paypal_secret','wallet_id','wallet_hashId','username','program_token','password','payout_setup_admin','payout_setup_user','min_payout_amount','merchant_id','secret_key'];
}
