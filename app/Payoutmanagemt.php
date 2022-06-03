<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payoutmanagemt extends Model
{
     use SoftDeletes;
     protected $table = 'payout_types';

    protected $fillable = ['payment_mode', 'status'];
}
