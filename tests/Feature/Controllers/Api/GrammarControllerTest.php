<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Grammar;
use Laravel\Passport\Passport;
use Tests\Generators\GrammarGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GrammarControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = UserGenerator::getAdminUser();
        Passport::actingAs($user);
        $this->json(
            'GET',
            route('api.grammar.index')
        )->assertStatus(200);
    }

    /**
     * Доступность страницы
     */
    public function testGrammarPage()
    {
        $user = UserGenerator::getAdminUser();
        Passport::actingAs($user);

        $grammar = Grammar::first();
        $this->json('GET', route('api.grammar.show',
            [
                'grammar' => $grammar->id
            ]))->assertStatus(200);

    }

    /**
     * Обновлние страницы админом
     */
    public function testAdminUpdateGrammarPage()
    {

        $user = UserGenerator::getAdminUser();
        Passport::actingAs($user);
        $grammar = Grammar::first();

        $update = [
            'name' => $this->faker->name
        ];
        $response = $this->json('PUT', route('api.grammar.update', [
            'grammar' => $grammar->id
        ]), $update);
        $response->assertJson($update);
    }

    /**
     * Обновлние страницы пользователем (403)
     */
    public function testUserUpdateGrammarPage()
    {

        $user = UserGenerator::createUser();
        Passport::actingAs($user);
        $grammar = Grammar::first();
        $update = [
            'name' => $this->faker->name
        ];
        $this->json('PUT', route('api.grammar.update', [
            'grammar' => $grammar->id
        ]), $update)->assertStatus(403);
    }

    /**
     * Создание страницы админом
     */
    public function testAdminCreateGrammarPage()
    {
        $user = UserGenerator::getAdminUser();
        Passport::actingAs($user);
        $data = GrammarGenerator::getCreateGrammarData();
        $count = Grammar::all()->count();

        $this->json('POST',
            route('api.grammar.store'), $data);
        $this->assertEquals($count + 1, Grammar::all()->count());
    }

    /**
     * Создание страницы пользователем (403)
     */
    public function testUserCreateGrammarPage()
    {
        $user = UserGenerator::createUser();
        Passport::actingAs($user);
        $data = GrammarGenerator::getCreateGrammarData();
        $response = $this->json('POST',
            route('api.grammar.store'), $data);
        $response->assertStatus(403);
    }

    /**
     * Тест страницы 404
     */
    public function test404()
    {
        $this->json('GET', '/wewqe')->assertStatus(404);
    }
}
