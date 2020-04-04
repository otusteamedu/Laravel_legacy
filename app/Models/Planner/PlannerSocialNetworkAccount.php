<?php

namespace App\Models\Planner;

use App\Models\BaseModel;

class PlannerSocialNetworkAccount extends BaseModel
{
    protected $fillable = [
        'login', 'password', 'user_id',
    ];

    protected $hidden = [];

    public function user(){
        $this->hasOne(\App\Models\User::class);
    }
}
