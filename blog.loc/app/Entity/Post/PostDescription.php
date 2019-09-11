<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class PostDescription extends Model
{
    protected $table = 'post_description';
    protected $fillable = [
        'post_id', 'lang', 'image', 'title', 'short_text', 'text', 'keywords', 'description', 'canonical_url', 'meta_tags',
    ];

    public function post()
    {
        return $this->belongsTo('App\Entity\Post\Post');
    }
}
