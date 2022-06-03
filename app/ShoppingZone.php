<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingZone extends Model
{
        use SoftDeletes;

    protected $table = 'shopping_zone';

    protected $fillable = ['zone_id','country_id','name','code','shipping_cost','status'];
}
