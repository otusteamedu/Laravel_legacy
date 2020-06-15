<?php

namespace Tests\Generators;

use App\Models\Group;
use App\Models\User;

/**
 * Class UserGenerator
 * Класс генератор пользователей для тестов
 * @package Tests\Generators
 */
class UserGenerator
{

    /**
     * Создать администратора
     * @return User
     */
    public static function generateAdmin(): User
    {
        $users = factory(User::class, 1)->create([
            'group_id' => Group::STAFF_ADMIN,
        ]);

        return $users->first();
    }
    /**
     * Создать сотрудника
     * @return User
     */
    public static function generateStaff(): User
    {
        $users = factory(User::class, 1)->create([
            'group_id' => Group::STAFFS[rand(0,2)],
        ]);

        return $users->first();
    }

    /**
     * Создать клиента
     * @return User
     */
    public static function generateClient(): User
    {
        $users = factory(User::class, 1)->create([
            'group_id' => current(Group::CLIENTS),
        ]);

        return $users->first();
    }

}
