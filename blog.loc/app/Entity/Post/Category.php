<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'slug', 'order'
    ];

    public function categoryDescriptions()
    {
        return $this->hasMany('App\Entity\Post\CategoryDescription');
    }

    public function posts()
    {
        return $this->hasMany('App\Entity\Post\Post');
    }
}
