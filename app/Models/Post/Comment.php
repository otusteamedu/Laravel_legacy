<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Comment
 * @package App\Models\Post
 *
 * @property int $id
 * @property string $content
 * @property string $short_content
 * @property bool $is_published
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property User $user
 * @property Post $post
 * @property Comment $parent
 * @property Collection $children
 */
class Comment extends BaseModel
{
    use SoftDeletes;

    /** @var int  */
    const SHORT_TEXT_COUNT = 30;

    /** @inheritDoc  */
    protected $fillable = [
        'content', 'user_id',
        'post_id', 'comment_id',
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
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class)->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'comment_id')->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class)->withTrashed();
    }

    /**
     * @return bool
     */
    public function getIsPublishedAttribute(): bool
    {
        return $this->published_at ? true : false;
    }

    /**
     * @return string
     */
    public function getShortContentAttribute(): string
    {
        return Str::substr($this->content, 0, self::SHORT_TEXT_COUNT).'&hellip;';
    }
}
