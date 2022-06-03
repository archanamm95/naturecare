<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productaddcart extends Model
{
    use SoftDeletes;
    protected $table = 'productaddcart';
    protected $fillable = ['user_id','product_id','cart_quantity','order_status'];
}
