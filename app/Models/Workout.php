<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ["time", "private"];

    public function complex() {
        return $this->belongsTo('App\Models\Complex');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }



}
