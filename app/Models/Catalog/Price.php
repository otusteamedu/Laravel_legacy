<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'catalog_item_price_languages';

    public function item()
    {
        return $this->belongsToMany(
            'App\Models\Catalog\Item', 
            'catalog_item_prices',
            'language_id',
            'item_id'
        );
    }
}
