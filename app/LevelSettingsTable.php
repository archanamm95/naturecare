<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelSettingsTable extends Model
{
    use SoftDeletes;

    protected $table = 'level_settings';

    protected $fillable = ['package','commission_level1','commission_level2','commission_level3','matching_level1','matching_level2','matching_level3','sponsor_comm'];
}
