<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use SoftDeletes;

    protected $table = 'vidoes';

    protected $fillable = ['title','video_url'];
}
