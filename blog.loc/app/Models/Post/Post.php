<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function tags()
    {
        return $this->belongsToMany('App\Models\Post\Tag', 'post_tag');
    }

    public static function addPost(
        string $title,
        string $image,
        string $shortText,
        string $text,
        string $keywords,
        int $userId,
        int $categoryId,
        datetime $publishDate
    )
    {
        $slug = Str::slug(Str::ascii($title));

        Post::create([
            'status' => Post::STATUS_DRAFT,
            'slug' => $slug,
            'image' => $image,
            'title' => $title,
            'short_text' => $shortText,
            'text' => $text,
            'keywords' => $keywords,
            'description' => null,
            'canonical_url' => null,
            'meta_tags' => null,
            'user_id' => $userId,
            'category_id' => $categoryId,
            'published_at' => $publishDate,
        ]);
    }
}
