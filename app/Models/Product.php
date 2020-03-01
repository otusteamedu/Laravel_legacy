<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'status' => 'bool',
        'url' => 'string',
        'quantity' => 'int',
        'data' => 'array',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
