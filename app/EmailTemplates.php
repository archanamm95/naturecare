<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplates extends Model
{
    use SoftDeletes;
        protected $table = 'email_templates' ;

        protected $fillable = ['subject','body', 'type','notify','status'];
}
