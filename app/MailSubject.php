<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailSubject extends Model
{
    use SoftDeletes;
    protected $table = 'mail_subjects' ;
    protected $fillable = ['message','message_subject'] ;
}
