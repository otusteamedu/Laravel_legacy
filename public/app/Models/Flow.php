<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $guarded = [];

    public function reasons()
    {
        return $this->hasMany('App\Models\Reason');
    }

    public function responsibility()
    {
        return $this->hasMany('App\Models\Responsibility');
    }

    public function flows()
    {
        return $this->hasMany('App\Models\Group');
    }

}
