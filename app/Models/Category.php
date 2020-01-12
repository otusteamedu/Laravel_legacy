<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function operations()
    {
        return $this->hasMany('App\Models\Operation');
    }
}