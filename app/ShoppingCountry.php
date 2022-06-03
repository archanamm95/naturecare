<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCountry extends Model
{
        use SoftDeletes;
     protected $table = 'shopping_country';

     protected $fillable = ['country_id','name','iso_code_2','iso_code_3','postcode_required','status'];
}
