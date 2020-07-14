<?php

namespace App\Models;

use App\Services\EducationPlans\EducationPlanService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\EducationPlan
 *
 * @property int $id
 * @property int $hours
 * @property int $subject_id
 * @property int $group_id
 * @property int|null $user_id
 * @property int $lesson_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereLessonTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationPlan whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Group $groups
 * @property-read \App\Models\LessonType $lessonType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 * @property-read \App\Models\Group $group
 */
class EducationPlan extends CacheModel
{
    /**
     * @var string
     */
    protected $rememberCacheTag = EducationPlanService::CACHE_TAG;

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function lessonType(): BelongsTo
    {
        return $this->belongsTo(LessonType::class);
    }

    /**
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
