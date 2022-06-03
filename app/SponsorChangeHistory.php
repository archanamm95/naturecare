<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorChangeHistory extends Model
{
    protected $table = 'sponsor_change_histories';

    protected $fillable = ['user_id','new_sponsor','old_sponsor','referals'];
}
