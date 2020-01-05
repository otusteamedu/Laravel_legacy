<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function images() {
        return $this->hasMany('App\Models\Image');
    }
}
