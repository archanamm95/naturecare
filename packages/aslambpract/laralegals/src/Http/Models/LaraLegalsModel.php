<?php

<?php namespace AslamBpract\LaraLegals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaraLegalsModel extends Model
{
    use SoftDeletes;

    protected $table = 'laralegal_contents';

    protected $fillable = ['terms','privacy','agreement'];

    
}
