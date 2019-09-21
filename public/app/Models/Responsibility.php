<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    protected $fillable=['name','group_id'];

    public function group(){
        return $this->belongsTo('App\Models\Group');
    }
}
