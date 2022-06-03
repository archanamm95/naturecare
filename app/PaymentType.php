<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    protected $table="payment_type";
    protected $fillable=['payment_name','status','code'];

    public static function updatePayOptionByKey($code, $status)
    {

        $payment        = PaymentType::where('code', $code)->first();
        $payment->status = $status;
        $payment->save();
        return;
    }
}
