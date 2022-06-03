<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactList extends Model
{
    

    use SoftDeletes ;

    protected $table = 'email_marketing_contact_lists';
    protected $fillable = ['name','description'];
}
