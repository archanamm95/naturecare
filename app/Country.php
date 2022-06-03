<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public static function getCountry()
    {
         $countries = self::all();
        return $countries;
    }
}
