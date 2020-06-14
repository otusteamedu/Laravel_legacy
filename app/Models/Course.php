<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property int $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 */
class Course extends BaseModel
{
    /** @var array  */
    protected $fillable = ['number'];

    /**
     * @return HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
