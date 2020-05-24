<?php

namespace App\Models\Lang\Ru;

use App\Models\Model;

class Category extends Model
{
    protected $table = 'categories_ru';

    protected $fillable = [
        'category_id', 'name'
    ];
}
