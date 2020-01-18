<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function images() {
        return $this->belongsToMany('App\Models\Image');
    }
}