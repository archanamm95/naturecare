<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryTrackingDetails extends Model
{
     use SoftDeletes;

    protected $table = 'delivery_tracking_details';

    protected $fillable = ['status','tracking_id'];
}
