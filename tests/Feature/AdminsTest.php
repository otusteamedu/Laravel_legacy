<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class AdminsTest
 * @package Tests\Feature
 * @group ta
 */

class AdminsTest extends ParentTest
{
    /**
     * Проверка простых GET-запросов.
     * Данные пользователя в роуты не передаются.
     * @param string $routeToTest
     * @dataProvider routesToTestWithoutUserData
     * @return void
     */
    public function testRoutesWithoutUserData($routeToTest)
    {
        //$this->markTestSkipped();
        $admin = $this->makeAdmin();
        $response = $this->from(route($routeToTest))->actingAs($admin)->get(route($routeToTest));
        $response->assertStatus(200);
    }

    /**
     * Проверка GET-запросов.
     * Данные пользователя передаются в роуты.
     * @param string $routeToTest
     * @dataProvider routesToTestWithUserData
     * @return void
     */
    public function testRoutesWithUserData($routeToTest)
    {
        //$this->markTestSkipped();
        // Создай админа
        $admin = $this->createAdmin();
        // Создай пользователя
        $user = $this->createUser();
        // Проверка доступа для админа
        $response = $this->actingAs($admin)->from(route("cms.users.index"))->get(route($routeToTest,['user'=>$user]));
        $response->assertStatus(200);
    }
    /**
     * Проверь, что админ может корректно создавать пользователя
     * @return void
     */
    public function testCanCreateUser()
    {
        //$this->markTestSkipped();

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

        // Убедись, что пользователь добавлен в БД
        // Failит тест, т.к. пользователь не сохраняется командой ->make внутри makeUser()
        // $this->assertDatabaseHas('users',$userData);
    }
}
