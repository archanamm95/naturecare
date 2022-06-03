<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Notifiable;
    protected $table = 'roles';
    protected $fillable=["role_name","link","submenu_count","is_root","parent_id","main_role","icon","role_no"];

    public function users()
    {
        /**
         *
         *   Users
         */
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
