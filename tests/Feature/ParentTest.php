<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ParentTest
 * Класс-родитель, просто содержит общие для потомков, полезные методы
 * @package Tests\Feature
 */

class ParentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Создай пользователя-админа
     * @return User
     */
    protected function makeAdmin():User
    {
        $user=factory(User::class)->make([
            'level' => User::LEVEL_ADMIN,
        ]);
        return $user;
    }

    /**
     * Создай пользователя-админа и сохрани его в БД
     * @return User
     */
    protected function createAdmin():User
    {
        $user=factory(User::class)->create([
            'level' => User::LEVEL_ADMIN,
        ]);
        return $user;
    }

    /**
     * Создай обычного пользователя
     * @return User
     */
    protected function makeUser():User
    {
        $user=factory(User::class)->make([
            'level' => User::LEVEL_USER,
        ]);
        return $user;
    }

    /**
     * Создай обычного пользователя и сохрание его в БД
     * @return User
     */
    protected function createUser():User
    {
        $user=factory(User::class)->create([
            'level' => User::LEVEL_USER,
        ]);
        return $user;
    }

    /**
     * Список роутов для теста
     * В эти роуты данные пользователя не передаются
     * @return array
     */
    public function routesToTestWithoutUserData()
    {
        return
            [
                ["cms.users.index"],
                ["cms.users.create"]
            ];
    }

    /**
     * Список роутов для теста
     * В эти роуты передаются данные пользователя
     * @return array
     */
    public function routesToTestWithUserData()
    {
        return
            [
                ["cms.users.show"],
                ["cms.users.edit"]
            ];
    }

    /**
     * Список роутов для теста
     * Эти роуты открыты для всех, не требуют авторизации
     * @return array
     */
    public function routesForEveryone()
    {
        return
            [
                ["katalog"],
                ["login"],
                ["register"]
            ];
    }
}
