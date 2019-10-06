<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'created_by'];

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


    public function users()
    {
        return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id');
    }
}
