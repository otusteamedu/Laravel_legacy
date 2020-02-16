<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function item()
    {
        return $this->hasMany(
            'App\Models\Catalog\Item', 
            'category_id');
    }

    public function specification()
    {
        return $this->belongsToMany(
            'App\Models\Catalog\Specification', 
            'categories_specification_allies');
    }
}
