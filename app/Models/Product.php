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

    protected $fillable = [
        'status',
        'url',
        'price',
        'quantity',
        'data'
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
