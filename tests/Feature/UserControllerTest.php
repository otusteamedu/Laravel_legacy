<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class userControllerTest
 * @package Tests\Feature
 * @group uc
 */

class userControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверка простых GET-запросов
     * Для админов должен показать страницу.
     * Для НЕ-админов - выдать ошибку 403.
     * @param string $routeToTest
     * @testWith
     * ["cms.users.index"]
     * ["cms.users.create"]
     * @return void
     */
    public function testRoutes($routeToTest)
    {
        // $this->markTestSkipped();
        // Проверка доступа для админа
        $admin = $this->makeAdmin();
        $response = $this->from(route($routeToTest))->actingAs($admin)->get(route($routeToTest));
        $response->assertStatus(200);//у админа должен быть доступ, код 200

        // Проверка доступа для простого пользователя
        $user = $this->makeUser();
        $response = $this->from(route($routeToTest))->actingAs($user)->get(route($routeToTest));
        $response->assertStatus(403);//у простого пользователя доступа нет, код 403
    }

    /**
     * Проверка GET-запросов, где используются данные пользователя
     * Для админов должен показать страницу.
     * Для НЕ-админов - выдать ошибку 403.
     * @param string $routeToTest
     * @testWith
     * ["cms.users.show"]
     * ["cms.users.edit"]
     * @return void
     */
    public function testRoutesWithUserData($routeToTest)
    {
        // $this->markTestSkipped();
        // Создай админа
        $admin = $this->createAdmin();
        // Создай пользователя
        $user = $this->createUser();
        // dd($user);
        // Проверка доступа для админа
        $response = $this->actingAs($admin)->from(route("cms.users.index"))->get(route($routeToTest,['user'=>$user]));

        $response->assertStatus(200);//у админа должен быть доступ, код 200

        // Проверка доступа для простого пользователя
        $response = $this->actingAs($user)->from(route("cms.users.index"))->get(route($routeToTest,['user'=>$user]));
        $response->assertStatus(403);//у простого пользователя доступа нет, код 403
    }

    /**
     * Проверь, что админ может корректно создавать пользователя
     * @return void
     */
    public function testAdminCanCreateUser()
    {
        // Создай админа
        $admin = $this->makeAdmin();

        // Создай простого пользователя
        $user = $this->makeUser();

        // Преобразуй пользователя в массив данных
        $userData = $user->toArray();

        // Убедись, что такого пользователя ещё нет в БД
        $this->assertDatabaseMissing('users',$userData);

        $response = $this->actingAs($admin)->from(route("cms.users.create"))->post(route('cms.users.store',$userData));
        $response->assertSessionHasNoErrors();

        // Убедись, что рядовой пользователь не имеет полномочий создать нового пользователя
        $response = $this->actingAs($user)->from(route("cms.users.create"))->post(route('cms.users.store',$userData));
        $response->assertStatus(403);
    }

    /**
     * Создай пользователя-админа
     * @return User
     */
    private function makeAdmin():User
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
    private function createAdmin():User
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
    private function makeUser():User
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
    private function createUser():User
    {
        $user=factory(User::class)->create([
            'level' => User::LEVEL_USER,
        ]);
        return $user;
    }
}
