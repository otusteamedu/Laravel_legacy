<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
