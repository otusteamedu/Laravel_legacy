<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string|null $published_at
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $producer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post byGroups($groupsId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post byTitle($title)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post isPublished()
 */
class Post extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    /** @var array  */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * @param Builder $builder
     * @param string $title
     * @return Builder
     */
    public function scopeByTitle(Builder $builder, string $title): Builder
    {
        return $builder->where('title', 'ilike', ('%' . $title . '%'));
    }

    /**
     * @param Builder $builder
     * @param array $groupsId
     * @return Builder
     */
    public function scopeByGroups(Builder $builder, array $groupsId): Builder
    {
        return $builder->whereHas('groups', function (Builder $builder) use ($groupsId): void {
            $builder->whereIn('groups.id', $groupsId);
        });
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsPublished(Builder $builder): Builder
    {
        return $builder->whereNotNull('published_at');
    }

    /**
     * @return BelongsTo
     */
    public function producer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'postable');
    }

    /**
     * @return MorphToMany
     */
    public function groups(): MorphToMany
    {
        return $this->morphedByMany(Group::class, 'postable');
    }
}
