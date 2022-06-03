<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PendingCommission extends Model
{
	 use SoftDeletes;

    protected $table = 'pending_commissions';

    protected $fillable = ['user_id', 'from_id','total_amount','tds','service_charge','payable_amount','payment_type','payment_status','note'];
}
