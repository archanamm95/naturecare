<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderproduct extends Model
{
    
     use SoftDeletes;

    protected $table = 'orderproduct';

    protected $fillable = ['order_id','product_id','user_id','count','amount','pv'];
}
