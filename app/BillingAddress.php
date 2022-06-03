<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingAddress extends Model
{
    use SoftDeletes;
    protected $table = 'billing_addresses';
    protected $fillable = ['fname','lname','email','country','state','city','address','pincode','user_id','address2'];
}
