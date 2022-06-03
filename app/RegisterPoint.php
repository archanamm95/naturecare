<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterPoint extends Model
{
    use SoftDeletes ;

    protected $table = 'register_point' ;

    protected $fillable = ['user_id','product_id','bv','count','total_amount','order_id','type'] ;
}
