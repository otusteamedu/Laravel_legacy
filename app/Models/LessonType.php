<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LessonType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectProgram[] $programs
 * @property-read int|null $programs_count
 */
class LessonType extends BaseModel
{
    /** @var int  */
    const LECTURE = 1;
    /** @var int  */
    const PRACTICE = 2;

    /** @var array  */
    protected $fillable = [
        'id',
        'type',
    ];

    /**
     * @return HasMany
     */
    public function programs(): HasMany
    {
        return $this->hasMany(SubjectProgram::class);
    }

    /**
     * @return HasMany
     */
    public function educationPlans(): HasMany
    {
        return $this->hasMany(EducationPlan::class);
    }
}
