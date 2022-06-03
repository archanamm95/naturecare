<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stripeCustomer extends Model
{
    use SoftDeletes;
    
    protected $table = 'stripe_customer';

    protected $fillable = ['user_id','customer_id','amount','currency','source','stripe_id','category_id','package_id','country_id'];
}
