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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transaction
 * @property-read int|null $transaction_count
 */
	class Reason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $created_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transaction
 * @property-read int|null $transaction_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCreatedBy($value)
 */
	class Student extends \Eloquent {}
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
 * @property-read \App\Models\Reason $reason
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\User $user
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $api_token
 * @property int $role_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transaction
 * @property-read int|null $transaction_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

