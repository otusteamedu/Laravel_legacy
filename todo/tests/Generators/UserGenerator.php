<?php

namespace Tests\Generators;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;


class UserGenerator
{
    public static function createUserAdmin(array $data = [])
    {
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

    public static function createUserAdminWithRole(array $data = [])
    {

        PermissionGenerator::createPermission(['id' => Permission::PERMISSION_ALL, 'name' => 'Полный доступ', 'route' => Permission::PERMISSION_ALL_ROUTE]);
        RoleGenerator::createRole(['id' => User::USER_ROLE_ADMIN, 'name' => 'Admin'], [Permission::PERMISSION_ALL]);
        return factory(User::class, 1)
            ->create($data)
            ->each(function ($user) {
                $user->roles()->sync([User::USER_ROLE_ADMIN]);

            })[0];
    }
}