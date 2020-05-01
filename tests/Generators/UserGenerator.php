<?php


namespace Tests\Generators;


use App\Models\User;

/**
 * Class UserGenerator
 * @package Tests\Generators
 */
class UserGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public static function createAdminUser(array $data = [])
    {
        return self::createUser(array_merge($data, [
            'role' => User::LEVEL_ADMIN,
        ]));
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public static function createMarketingUser(array $data = [])
    {
        return self::createUser(array_merge($data, [
            'role' => User::LEVEL_MARKETING,
        ]));
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public static function createUser (array $data = [])
    {
        return factory(User::class)->create($data);
    }
}
