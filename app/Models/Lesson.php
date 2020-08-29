<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
 * @property-read \App\Models\RoomOccupation|null $occupation
 */
class Lesson extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function educationPlan(): BelongsTo
    {
        return $this->belongsTo(EducationPlan::class);
    }

    /**
     * @return MorphOne
     */
    public function occupation(): MorphOne
    {
        return $this->morphOne(RoomOccupation::class, 'occupationable');
    }
}
