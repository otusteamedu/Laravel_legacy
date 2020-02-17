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
}
