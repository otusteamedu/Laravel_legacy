<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PagesTest extends TestCase
{
    /**
     * Тест главной страницы
     * @group common
     * @return void
     */
    public function testMainPage()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSeeText('Welcome');
    }

    /**
     * Тест страницы на английском
     * @group common
     * @return void
     */
    public function testEnPage()
    {
        $this->get('/en')
            ->assertStatus(200)
            ->assertSeeText('Refresh');
    }

    /**
     * Тест страницы на русском
     * @group common
     * @return void
     */
    public function testRuPage()
    {

        $this->get('/ru')
            ->assertStatus(200)
            ->assertSeeText('Обновить');
    }


    /**
     * Тест страницы логина
     * @group common
     * @return void
     */
    public function testLoginPage()
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertSeeText('Login');
    }

    /**
     * Тест страницы регистрации
     * @group common
     * @return void
     */
    public function testRegisterPage()
    {
        $this->get(route('register'))
            ->assertStatus(200)
            ->assertSeeText('Register');
    }


    /**
     * Тест редиректа страницы успешного входа
     * @group common
     * @return void
     */
    public function testSuccessLoginRedirectPage()
    {
        $this->get(route('home'))
            ->assertStatus(302);
    }

    /**
     * Тест страницы страницы успешного входа
     * @group common
     * @return void
     */
    public function testSuccessLoginPage()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSeeText('You are logged in!')
        ;
    }


    /**
     * Тест страниц CMS закрытых для под авторизацию
     * @group common
     * @return void
     */
    public function testCMSPageRedirect()
    {
        $response = $this->get(route('cms.index'));
        $response->assertStatus(302);
    }
}
