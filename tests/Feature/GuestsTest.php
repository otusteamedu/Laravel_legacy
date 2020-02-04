<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class GuestsTest
 * @package Tests\Feature
 * @test
 * @group tg
 */

class GuestsTest extends ParentTest
{
    /**
     * Проверка GET-запросов, которые не требуют авторизации.
     * @param string $routeToTest
     * @dataProvider routesForEveryone
     * @return void
     */
    public function testGuestReceives200($routeToTest)
    {
        //$this->markTestSkipped();
        $response = $this->from(route($routeToTest))->get(route($routeToTest));
        $response->assertStatus(200);
    }

    /**
     * Проверка GET-запросов, которые требуют авторизации.
     * Если не авторизован, то редирект на /login.
     * Может из-за редиректа и выдаёт ошибку 302 вместо 401 ?
     * ВНИМАНИЕ! Получается, что этот тест заточен на получение ошибки 302, т.е. предопределён и не очень полезен.
     * @param string $routeToTest
     * @dataProvider routesToTestWithoutUserData
     * @return void
     */
    public function testGuestRedirected($routeToTest)
    {
        //$this->markTestSkipped();
        $response = $this->from(route($routeToTest))->get(route($routeToTest));
        $response->assertStatus(302);
    }
}
