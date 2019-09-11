<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    protected $table = 'category_description';
    protected $fillable = [
        'lang', 'category_id', 'title'
    ];

    public function categories()
    {
        return $this->belongsTo('App\Entity\Post\Category');
    }
}
