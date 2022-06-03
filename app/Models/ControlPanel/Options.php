<?php

namespace App\Models\ControlPanel;

use DB;
// use App\Models\ControlPanel\Options;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'options';
    public static $option_cache = null;

    public static function getOptions()
    {
        return DB::table('options')->get();
    }


    public static function option($key, $default = null)
    {

       // dd(DB::table('options')->get());

        if (self::$option_cache === null) {
            foreach (DB::table('options')->get() as $option) {
            //   dd($option);
                $keys = explode('.', $option->key);
                self::$option_cache[$keys[0]][$keys[1]] = $option->value;
            }
        }
        $parts = explode('.', $key);
        if (count($parts) == 2) {
            return self::$option_cache[$parts[0]][$parts[1]] ?: $default;
        } else {
            return self::$option_cache[$parts[0]] ?: $default;
        }
    }

    public static function updateOptionByKey($key, $value)
    {
          $option        = Options::where('key', $key)->first();
        $option->value = $value;
        $option->save();
        return;
    }
}
