<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['slug', 'tag'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post\Post', 'post_tag');
    }
}
