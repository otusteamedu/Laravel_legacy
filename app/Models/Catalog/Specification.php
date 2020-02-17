<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{

    protected $table = 'catalog_specifications';

    public function category()
    {
        return $this->belongsToMany(
            'App\Models\Catalog\Category', 
            'categories_specification_allies');
    }
}
