<?php

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 01.05.2020
 * Time: 14:00
 */

namespace Tests\Generators;

use App\Models\User;

class UserGenerator
{
    public static function createAdminUser(array $data = [])
    {
        return self::createUser(array_merge($data, [
            'role_id' => 1,
        ]));
    }

    public static function createModeratorUser(array $data = [])
    {
        return self::createUser(array_merge($data, [
            'role_id' => 3,
        ]));
    }

    public static function createUser(array $data = [])
    {
        return factory(User::class)->create($data);
    }
}