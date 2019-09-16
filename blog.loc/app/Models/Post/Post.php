<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_PLANNED = 'planned';

    protected $fillable = [
        'status',
        'slug',
        'image',
        'title',
        'short_text',
        'text',
        'keywords',
        'description',
        'canonical_url',
        'meta_tags',
        'user_id',
        'category_id',
        'published_at',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Post\Category', 'category_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id', 'id');
    }
}
