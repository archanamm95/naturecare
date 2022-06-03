<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoolHistory extends Model
{
     use SoftDeletes;

    protected $table = 'pool_history';

    protected $fillable = ['total_bv','total_count','poolbonus','qualified_user_count','share_amount'];
}
