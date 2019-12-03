<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['slug', 'category'];

    public function posts()
    {
        return $this->hasMany('App\Models\Post\Post','category_id', 'id');
    }
}
