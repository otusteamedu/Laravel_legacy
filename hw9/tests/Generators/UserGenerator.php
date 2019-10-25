<?php

namespace Tests\Generators;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class UserGenerator
{
    public static function createUserAdmin(array $data = [])
    {
        $role = factory(Role::class, 1)->create(['id' => User::USER_ROLE_ADMIN, 'name' => 'Admin'])[0];
        $permission =  factory(Permission::class, 1)->create(['id' => Permission::PERMISSION_ALL, 'name' => 'Полный доступ', 'route' => Permission::PERMISSION_ALL_ROUTE]);
        $role->permissions()->sync([Permission::PERMISSION_ALL]);
        return factory(User::class, 1)
            ->create($data)
            ->each(function ($user) {
                $user->roles()->sync([User::USER_ROLE_ADMIN]);

            })[0];
    }

    public static function createUser(array $data = [])
    {
        factory(Role::class, 1)->create(['id' => User::USER_ROLE_USER, 'name' => 'User']);
        return factory(User::class, 1)
            ->create($data)
            ->each(function ($user) {
                $user->roles()->sync([User::USER_ROLE_USER]);

            });

    }
}