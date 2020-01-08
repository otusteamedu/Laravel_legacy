<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Post
 * @package App\Models\Post
 *
 * @property int $id
 * @property string $image
 * @property string $content
 * @property string $link
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property User $user
 * @property Collection $rubrics
 * @property Collection $comments
 */
class Post extends BaseModel
{
    /** @inheritDoc  */
    protected $fillable = [
        'name', 'image', 'content', 'link', 'slug',
        'title', 'keywords', 'description', 'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function rubrics(): BelongsToMany
    {
        return $this->belongsToMany(
            Rubric::class,
            'post_rubric',
            'post_id',
            'rubric_id'
        );
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
