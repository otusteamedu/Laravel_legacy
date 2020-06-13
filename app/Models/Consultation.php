<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Consultation
 *
 * @property int $id
 * @property string $date
 * @property int|null $limit
 * @property bool $approved
 * @property int $room_id
 * @property int $user_id
 * @property int $schedule_id
 * @property int $subject_id
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultation whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule $schedule
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 */
class Consultation extends BaseModel
{
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
