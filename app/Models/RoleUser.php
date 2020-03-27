<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\RoleUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $role_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereUserId($value)
 */
class RoleUser extends Pivot
{
}
