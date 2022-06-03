<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignGroup extends Model
{
    use SoftDeletes;
    protected $table = 'campaign_groups' ;

    protected $fillable = ['name', 'description'];
}
