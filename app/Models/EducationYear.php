<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\EducationYear
 *
 * @property int $id
 * @property string $start_at
 * @property string $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EducationYear whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Course|null $course
 */
class EducationYear extends BaseModel
{
    /** @var array  */
    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    /**
     * @param Builder $builder
     * @param Carbon $date
     * @return Builder
     */
    public function scopeDate(Builder $builder, Carbon $date): Builder
    {
        return $builder->where('start_at', '<=', $date)
            ->where('end_at', '>=', $date);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeCurrent(Builder $builder): Builder
    {
        return $builder->date(Carbon::now());
    }

    /**
     * @return HasOne
     */
    public function course(): HasOne
    {
        return $this->hasOne(Course::class);
    }

    /**
     * @return string
     */
    public function getPeriodAttribute(): string
    {
        return $this->start_at->format('Y-m-d') . ' - ' . $this->end_at->format('Y-m-d');
    }
}
