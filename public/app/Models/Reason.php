<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable=['name','group_id', 'amount'];

    public function group(){
        return $this->belongsTo('App\Models\Group');
    }
}
