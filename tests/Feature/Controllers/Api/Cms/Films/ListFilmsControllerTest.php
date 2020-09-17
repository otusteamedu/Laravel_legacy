<?php

namespace Tests\Feature\Controllers\Api\Cms\Films;


use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\Generators\UserGenerator;
use Tests\Generators\FilmGenerator;
use Tests\TestCase;

class ListFilmsControllerTest extends TestCase
{
    

    use RefreshDatabase;
    use WithFaker;

    /**
     * @group api
     * @group films_api
     */
    public function testList()
    {

        $user = UserGenerator::createAdminUser();

        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('films.index')
        )
            ->assertStatus(200);

        $response->assertJsonCount(3);
    }

    /**
     * @group api
     * @group films_api
     */
    public function testListReturn401IfNoUser()
    {

        $this->json(
            'GET',
            route('films.index')
        )
            ->assertStatus(401);
    }

}
