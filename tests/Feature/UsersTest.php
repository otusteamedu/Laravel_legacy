<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class UsersTest
 * @package Tests\Feature
 * @group tu
 */

class UsersTest extends ParentTest
{
    /**
     * Проверка простых GET-запросов.
     * Данные пользователя в роуты не передаются.
     * Обычный пользователь не имеет доступа к таким роутам, поэтому должен получить ошибку 403.
     * @param string $routeToTest
     * @dataProvider routesToTestWithoutUserData
     * @return void
     */
    public function testRoutesWithoutUserData($routeToTest)
    {
        //$this->markTestSkipped();
        $user = $this->makeUser();
        $response = $this->from(route($routeToTest))->actingAs($user)->get(route($routeToTest));
        $response->assertStatus(403);
    }

    /**
     * Проверка GET-запросов.
     * Данные пользователя передаются в роуты.
     * Обычный пользователь не имеет доступа к таким роутам, поэтому должен получить ошибку 403.
     * @param string $routeToTest
     * @dataProvider routesToTestWithUserData
     * @return void
     */
    public function testRoutesWithUserData($routeToTest)
    {
        // $this->markTestSkipped();
        // Создай пользователя
        $user = $this->createUser();
        // Проверка доступа для простого пользователя
        $response = $this->actingAs($user)->from(route("cms.users.index"))->get(route($routeToTest,['user'=>$user]));
        $response->assertStatus(403);
    }

    /**
     * Проверь, что рядовой пользователь не может создать нового пользователя
     * @return void
     */
    public function testCannotCreateUser()
    {
        // $this->markTestSkipped();

        // Создай простого пользователя
        $user = $this->makeUser();

        // Преобразуй пользователя в массив данных
        $userData = $user->toArray();

        // Убедись, что такого пользователя ещё нет в БД
        $this->assertDatabaseMissing('users',$userData);

        // Убедись, что рядовой пользователь не имеет полномочий создать нового пользователя
        $response = $this->actingAs($user)->from(route("cms.users.create"))->post(route('cms.users.store',$userData));
        $response->assertStatus(403);

        // Убедись, что такого пользователя также нет в БД
        $this->assertDatabaseMissing('users',$userData);
    }

}
