<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\StudentUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser query()
 * @mixin \Eloquent
 */
class StudentUser extends Pivot
{
    protected $table = 'student_user';
    public $timestamps = false;

}
