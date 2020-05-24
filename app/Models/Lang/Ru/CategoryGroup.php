<?php

namespace App\Models\Lang\Ru;

use App\Models\Model;

class CategoryGroup extends Model
{
    protected $table = 'category_groups_ru';

    protected $fillable = [
        'category_group_id', 'name'
    ];
}
