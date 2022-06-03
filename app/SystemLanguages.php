<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemLanguages extends Model
{
     use SoftDeletes;

    protected $table = 'system_languages';

    protected $fillable = ['language','locale','status','default'];

    public static function updateLanguageOptionByKey($id, $status)
    {
        $langauge=self::find($id);
        $langauge->status = $status;
        $langauge->save();
        return;
    }
}
