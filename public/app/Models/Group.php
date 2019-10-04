<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];

    public function responsibilities()
    {
        return $this->hasMany('App\Models\Responsibility');
    }

    public function reasons()
    {
        return $this->hasMany('App\Models\Reason');
    }


    public function flows()
    {
        return $this->hasMany('App\Models\Flow');
    }


//    public function flows()
//    {
//        return $this->hasManyThrough('App\Models\Flow', 'App\Models\Responsibility');
//    }
}
