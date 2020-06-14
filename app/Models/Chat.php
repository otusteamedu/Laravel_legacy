<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Chat
 *
 * @property int $id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Student $student
 */
class Chat extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
