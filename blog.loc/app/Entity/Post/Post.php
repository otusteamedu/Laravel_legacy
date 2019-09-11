<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_PLANNED = 'planned';

    protected $table = 'posts';
    protected $fillable = [
        'slug', 'status', 'user_id', 'category_id', 'published_at'
    ];

    public function postDescriptions()
    {
        return $this->hasMany('App\Entity\PostDescription', 'post_id', 'id');
    }
}
