<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UsertypeHistory extends Model
{
    use SoftDeletes;

    protected $table = 'usertype_history';

    protected $fillable = ['user_id','user_type'];
    
}
