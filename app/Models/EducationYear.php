<?php

namespace App\Models;

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
    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function course(): HasOne
    {
        return $this->hasOne(Course::class);
    }
}
