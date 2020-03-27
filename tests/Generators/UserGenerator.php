<?php

namespace Tests\Generators;

use App\Models\User;
use App\Models\Role;

class UserGenerator
{
    //@ToDo: заюзать /*$userService = $this->getUserRepository(); $userService->updateFromArray($user, UserGenerator::generateUserCreateData());*/

    public static function createAdminUser(array $data = []) {
        $user = self::createUser(array_merge($data, []));
        $roleAdministratorName = Role::AVAILABLE_SPEC_ROLE_LIST['administrators'];

        if (Role::where('name', $roleAdministratorName)->count() > 0) {
            $role = Role::where('name', $roleAdministratorName)->first();
        } else {
            $role = factory(Role::class)->create(['name' => $roleAdministratorName]);
        }

        $user->roles()->attach($role);

        return $user;
    }

    public static function createModeratorUser(array $data = []) {
        $user = self::createUser(array_merge($data, []));
        $roleModeratorsName = Role::AVAILABLE_SPEC_ROLE_LIST['moderators'];

        if (Role::where('name', $roleModeratorsName)->count() > 0) {
            $role = Role::where('name', $roleModeratorsName)->first();
        } else {
            $role = factory(Role::class)->create(['name' => $roleModeratorsName]);
        }

        $user->roles()->attach($role);

        return $user;
    }

    public static function createSimpleUser(array $data = []) {
        $user = self::createUser(array_merge($data, []));

        return $user;
    }

    public static function createUser(array $data = []) {
        if (!isset($data['active'])) {
            $data['active'] = 1;
        }

        return factory(User::class)->create($data);
    }

    public static function generateUserCreateData(): array
    {
        $data = factory(User::class)->make()->toArray();

        if (empty($data['password'])) {
            $data['password'] = time();
        }

        return $data;
    }
}
