<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductHistory extends Model
{
    use SoftDeletes;

    protected $table = 'product_history';

    protected $fillable = ['user_id','purchase_history_id','product_id','quantity','price','total_price'];
}
