<?php
/**
 * Description of UserGenerator.php
 */

namespace Tests\Generators;


use App\Models\User;

class UserGenerator
{

    public static function createAdminUser(array $data = [])
    {
        return self::createUser(array_merge($data, [
            'level' => User::LEVEL_ADMIN,
        ]));
    }

    public static function createModeratorUser(array $data = [])
    {
        return self::createUser(array_merge($data, [
            'level' => User::LEVEL_MODERATOR,
        ]));
    }

    public static function createUser(array $data = [])
    {
        return factory(User::class)->create($data);
    }

}
