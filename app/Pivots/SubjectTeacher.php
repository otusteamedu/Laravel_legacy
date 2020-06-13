<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Pivots\SubjectTeacher
 *
 * @property int $subject_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pivots\SubjectTeacher whereUserId($value)
 * @mixin \Eloquent
 */
class SubjectTeacher extends Pivot
{
    //
}
