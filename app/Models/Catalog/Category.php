<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function specification()
    {
        return $this->belongsToMany(Specification::class);
    }
}
