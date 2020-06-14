<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultation[] $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoomOccupation[] $occupations
 * @property-read int|null $occupations_count
 */
class Room extends BaseModel
{
    /**
     * @return HasMany
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * @return HasMany
     */
    public function occupations(): HasMany
    {
        return $this->hasMany(RoomOccupation::class);
    }
}
