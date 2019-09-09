<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\RoleUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
class RoleUser extends Model
{
    //
}
