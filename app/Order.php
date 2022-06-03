<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $fillable = ['user_id','total_count','total_amount','total_pv','shipping_id','invoice_id','status'];
}
