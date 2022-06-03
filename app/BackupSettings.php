<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BackupSettings extends Model
{
    protected $table = 'backup_settings' ;

    protected $fillable = ['client_id', 'client_secret','refresh_token','folder_id'];
}
