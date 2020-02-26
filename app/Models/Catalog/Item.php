<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price()
    {
        return $this->belongsToMany(
            'App\Models\Catalog\Price', 
            'item_prices',
            'item_id',
            'language_id'
        );
    }

    public function specification(){
        return $this->belongsToMany(
            'App\Models\Catalog\CategorySpecification',
            'item_specification_values',
            'category_specification_id',
            'item_id'
        );
    }
}
