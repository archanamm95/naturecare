<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
        
        use SoftDeletes ;

        protected $table = 'email_marketing_contacts';


        protected $fillable = ['email','name','lastname','address','list_id','mobile'];
}
