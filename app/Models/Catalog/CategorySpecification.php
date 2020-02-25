<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategorySpecification extends Pivot
{

    protected $table = 'categories_specification_allies';

    public function item(){
        return $this->belongsToMany(
            'App\Models\Catalog\Item',
            'catalog_item_specification_values',
            'item_id',
            'specification_allies_id'
        );
    }
}
