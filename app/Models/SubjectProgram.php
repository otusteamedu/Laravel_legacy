<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\SubjectProgram
 *
 * @property int $id
 * @property string $title
 * @property mixed|null $meta
 * @property int $sort
 * @property int $subject_id
 * @property int $user_id
 * @property int $lesson_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereLessonTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectProgram whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\LessonType $lessonType
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 */
class SubjectProgram extends BaseModel
{
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lessonType(): BelongsTo
    {
        return $this->belongsTo(LessonType::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
