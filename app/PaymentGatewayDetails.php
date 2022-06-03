<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentGatewayDetails extends Model
{
     use SoftDeletes;
     protected $table = 'payment_gateway_details' ;

     protected $fillable = ['bank_details','btc_address','auth_merchant_name','auth_transaction_key','rave_public_key','rave_secret_key','paypal_username','paypal_password','paypal_secret_key','stripe_secret_key','stripe_public_key','ipaygh_merchant_key','skrill_mer_email'] ;
}
