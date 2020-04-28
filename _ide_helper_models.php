<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\RoleUser
 *
 * @property int $role_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
	class RoleUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StudentUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser query()
 * @mixin \Eloquent
 * @property int $student_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentUser whereUserId($value)
 */
	class StudentUser extends \Eloquent {}
}

