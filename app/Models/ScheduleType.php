<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\SheduleType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleType whereUpdatedAt($value)
 */
class ScheduleType extends BaseModel
{
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
