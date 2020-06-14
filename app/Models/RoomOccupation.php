<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\RoomOccupation
 *
 * @property int $id
 * @property string $date
 * @property int $room_id
 * @property int $schedule_id
 * @property int $occupationable_id
 * @property string $occupationable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $occupationable
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule $schedule
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereOccupationableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereOccupationableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomOccupation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoomOccupation extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * @return BelongsTo
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * @return MorphTo
     */
    public function occupationable(): MorphTo
    {
        return $this->morphTo();
    }
}
