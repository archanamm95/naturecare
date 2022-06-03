<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['content','cookie','upload_user','min_p_sales','p_sales_per','share_partner_condition'];

    public static function getSettings()
    {
        return DB::table('settings')->get();
    }
}
