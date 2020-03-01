<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $casts = [
        'status' => 'bool',
        'url' => 'string',
        'group' => 'int',
        'data' => 'array',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function productImages()
    {
        return $this->hasManyThrough(ProductImage::class, Product::class);
    }

}
