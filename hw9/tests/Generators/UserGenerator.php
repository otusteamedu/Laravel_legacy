<?php

namespace Tests\Generators;


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
        return factory(User::class, 1)
            ->create($data)
            ->each(function ($user) {
                $user->roles()->sync([User::USER_ROLE_USER]);

            });

    }
}