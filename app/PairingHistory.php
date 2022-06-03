<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PairingHistory extends Model
{
    

    use SoftDeletes;

    protected $table = 'pairing_history';


    protected $fillable = ['user_id','total_left','total_right','left','right','first_percent','first_amount','second_percent','second_amount','third_percent','third_amount'];
}
