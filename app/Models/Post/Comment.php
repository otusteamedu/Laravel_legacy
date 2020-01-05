<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Comment
 * @package App\Models\Post
 *
 * @property int $id
 * @property string $content
 * @property User $user
 * @property Post $post
 * @property Comment $parent
 * @property Collection $children
 */
class Comment extends BaseModel
{
    /** @inheritDoc  */
    protected $table = 'comments';

    /** @inheritDoc  */
    protected $fillable = [
        'content', 'user_id',
        'post_id', 'comment_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class);
    }
}
