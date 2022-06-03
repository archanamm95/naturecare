<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceTable extends Model
{
    use SoftDeletes;
    protected $table = 'invoice_table' ;
    protected $fillable = ['user_id','order_id','invoice_id','status','bank_slip','payment_details','bank_slip2','bank_slip3','payer_name','payment_date','additional_details'];
}
