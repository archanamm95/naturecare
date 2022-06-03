<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashbackSettings extends Model
{
     protected $table = 'cashback_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['sale_count','cash_back'];

   
}
