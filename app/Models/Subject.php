<?php

namespace App\Models;

use App\Pivots\SubjectTeacher;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EducationPlan[] $educationPlans
 * @property-read int|null $education_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectProgram[] $programs
 * @property-read int|null $programs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $teacher
 * @property-read int|null $teacher_count
 */
class Subject extends BaseModel
{
    public function teacher(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')
            ->using(SubjectTeacher::class);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(SubjectProgram::class);
    }

    public function educationPlans(): HasMany
    {
        return $this->hasMany(EducationPlan::class);
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, (new EducationPlan)->getTable());
    }
}
