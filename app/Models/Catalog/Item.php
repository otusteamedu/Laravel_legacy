<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'catalog_items';

    public function category()
    {
        return $this->belongsTo('App\Modules\Catalog\Category', 'category_id', 'id');
    }

    public function price()
    {
        return $this->belongsToMany(
            'App\Models\Catalog\Price', 
            'catalog_item_prices',
            'item_id',
            'language_id'
        );
    }
}
