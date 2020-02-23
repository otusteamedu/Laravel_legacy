<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Post
 * @package App\Models\Post
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $content
 * @property string $link
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property bool $is_published
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property User $user
 * @property Collection $rubrics
 * @property Collection $comments
 */
class Post extends BaseModel
{
    use SoftDeletes;

    public const IMAGE_FIELD = 'image';

    public const IMAGE_PATH = 'post';

    /** @inheritDoc  */
    protected $fillable = [
        'name', 'image', 'content', 'link', 'slug',
        'title', 'keywords', 'description', 'user_id',
        'published_at',
    ];

    /** @inheritDoc  */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
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

    /**
     * @return bool
     */
    public function getIsPublishedAttribute(): bool
    {
        return $this->published_at ? true : false;
    }
}
