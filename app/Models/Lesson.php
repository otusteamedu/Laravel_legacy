<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $date
 * @property int $room_id
 * @property int $education_plan_id
 * @property int $schedule_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereEducationPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\EducationPlan $educationPlan
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule $schedule
 */
class Lesson extends BaseModel
{
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function educationPlan(): BelongsTo
    {
        return $this->belongsTo(EducationPlan::class);
    }
}
