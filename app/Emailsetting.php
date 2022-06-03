<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emailsetting extends Model
{
    use SoftDeletes;
     protected $table="email_setting";

     protected $fillable=['host','port','username','password','sendmail','pretend','incoming_server','incomig_port','outgoing_server','outgoing_port','from_name','from_email'];
}
