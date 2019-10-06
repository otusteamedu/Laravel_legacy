<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    protected $fillable=['name','group_id'];

    public function group(){
        return $this->belongsTo('App\Models\Group');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'responsibility_user', 'responsibility_id', 'user_id');
    }
}
