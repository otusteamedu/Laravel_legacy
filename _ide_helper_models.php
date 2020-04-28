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
 * App\Models\Reason
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Reason extends \Eloquent {}
}

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
 * App\Models\StudentsUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsUser query()
 * @mixin \Eloquent
 */
	class StudentsUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $student_id
 * @property int $user_id
 * @property int $reason_id
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUserId($value)
 * @mixin \Eloquent
 */
	class Transaction extends \Eloquent {}
}

