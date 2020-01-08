<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Rubric
 * @package App\Models\Post
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property Collection $posts
 */
class Rubric extends BaseModel
{
    /** @inheritDoc  */
    protected $table = 'rubrics';

    /** @inheritDoc  */
    protected $fillable = [
        'name', 'slug', 'title',
        'keywords', 'description',
    ];

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'post_rubric',
            'rubric_id',
            'post_id'
        );
    }
}
