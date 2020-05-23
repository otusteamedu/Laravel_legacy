<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ["name", "image", "description"];

    public function equipment() {
        return $this->belongsToMany('App\Models\Equipment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function complex() {
        return $this->belongsToMany('App\Models\Complex');
    }
}
