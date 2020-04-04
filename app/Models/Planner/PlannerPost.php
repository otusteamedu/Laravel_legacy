<?php

namespace App\Models\Planner;

use App\Models\BaseModel;

class PlannerPost extends BaseModel
{
    protected $fillable = [
        'description',
        'user_id',
        'planner_geo_id',
        'social_network_account_id'
    ];

    public function user(){
        $this->hasOne('App\Models\User');
    }

    public function socialNetworkAccount(){
        $this->hasOne(PlannerSocialNetworkAccount::class);
    }
}
