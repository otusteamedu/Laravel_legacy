<?php

namespace App\Models;

use App\Scopes\EducationYearScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Group
 *
 * @property int $id
 * @property int $number
 * @property int $course_id
 * @property int $education_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereEducationYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $teachers
 * @property-read int|null $teachers_count
 * @property-read \App\Models\EducationYear $year
 */
class Group extends BaseModel
{
    protected $fillable = [
        'number',
        'course_id',
        'education_year_id',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new EducationYearScope());
    }

    /**
     * @param Builder $builder
     * @param int $number
     * @return Builder
     */
    public function scopeNumber(Builder $builder, int $number): Builder
    {
        return $builder->where('number', $number);
    }

    /**
     * @param Builder $builder
     * @param string $name
     * @return Builder
     */
    public function scopeTeacherName(Builder $builder, string $name): Builder
    {
        return $builder->whereHas('teachers', function (Builder $builder) use ($name): Builder {
            return $builder->lastName($name);
        });
    }

    /**
     * @param Builder $builder
     * @param int $courseId
     * @return Builder
     */
    public function scopeCourseNumber(Builder $builder, int $courseId): Builder
    {
        return $builder->whereHas('course', function (Builder $builder) use ($courseId): Builder {
            return $builder->number($courseId);
        });
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function year(): BelongsTo
    {
        return $this->belongsTo(EducationYear::class, 'education_year_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, (new EducationPlan)->getTable());
    }

    /**
     * @return BelongsToMany
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, (new EducationPlan)->getTable());
    }

    /**
     * @return HasMany
     */
    public function educationPlans(): HasMany
    {
        return $this->hasMany(EducationPlan::class);
    }

    /**
     * @return HasMany
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    /**
     * @return string
     */
    public function getGroupCourseAttribute(): string
    {
        return $this->number . ' | ' . $this->course->number ?? ' - ';
    }
}
