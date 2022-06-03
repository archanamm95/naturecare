<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInactiveHistory extends Model
{
    use SoftDeletes;

    protected $table = 'user_inactive_history';

    protected $fillable = ['user_id','join_date'] ;
}
