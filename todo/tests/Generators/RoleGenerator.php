<?php

namespace Tests\Generators;

use App\Models\Role;
use App\Models\Permission;


class RoleGenerator
{
    public static function createRole(array $data = [], array $permission = [])
    {
        return factory(Role::class, 1)
            ->create($data)
            ->each(function ($role, $permission) {
                //$role->permissions()->sync($permission);
                $role->permissions()->sync([Permission::PERMISSION_ALL]);

            })[0];
    }
}