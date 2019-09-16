<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    public function group(){
        return $this->belongsTo('App\Models\Group');
    }
}
