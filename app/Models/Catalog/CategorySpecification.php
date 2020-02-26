<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategorySpecification extends Pivot
{

    public function item(){
        return $this->belongsToMany(
            'App\Models\Catalog\Item',
            'item_specification_values',
            'item_id',
            'category_specification_id'
        );
    }
}
