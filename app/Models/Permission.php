<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permissions.
 *
 * @property int               $id
 * @property string            $name
 * @property Role[]|Collection $roles
 * @property User[]|Collection $users
 */
class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
