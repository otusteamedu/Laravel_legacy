<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AuthTest extends TestCase
{

    /**
     * Тест регистрации
     * @group auth
     * @return void
     */
    public function testUserRegisterPage()
    {

        $this->post(route('register', [
            'name' => 'name',
            'email' => 'email@test.info',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]))
            ->assertStatus(302)
        ;
        $this->assertDatabaseHas('users', [
            'name' => 'name',
        ]);
    }

    /**
     * Тест авторизации
     * @group auth
     * @return void
     */
    public function testLoginPage()
    {

        $user = UserGenerator::createAdminUser();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);

        $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password',
        ]))
            ->assertStatus(302)
        ;

        $this->get(route('home'))
            ->assertStatus(200);
    }


    /**
     * Тест разлогинивания
     * @group auth
     * @return void
     */
    public function testLogoutPage()
    {

        $user = UserGenerator::createAdminUser();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);

        $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password',
        ]))
            ->assertStatus(302)
        ;

        $this->post(route('logout', []))
            ->assertStatus(302)
        ;

        $this->get(route('home'))
            ->assertStatus(302);
    }


    /**
     * Тест перехода  на страницы доступные зарегистрированным пользователям
     * @group auth
     * @return void
     */
    public function testCmsPage()
    {

        $user = UserGenerator::createModeratorUser();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);

        $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password',
        ]))
            ->assertStatus(302)
        ;

        $this->get(route('cms.index'))
            ->assertStatus(200);
    }

    /**
     * Тест перехода на страницы недоступные зарегистрированным пользователям
     * @group auth
     * @return void
     */
    public function testCmsAdminPageAccessDenied()
    {

        $user = UserGenerator::createModeratorUser();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);

        $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password',
        ]))
            ->assertStatus(302)
        ;

        $this->get(route('cms.users.index'))
            ->assertStatus(403);
    }

    /**
     * Тест перехода на страницы доступные только администраторам
     * @group auth
     * @return void
     */
    public function testCmsAdminPageAccess()
    {

        $user = UserGenerator::createAdminUser();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);

        $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password',
        ]))
            ->assertStatus(302)
        ;

        $this->get(route('cms.users.index'))
            ->assertStatus(200);
    }
}
