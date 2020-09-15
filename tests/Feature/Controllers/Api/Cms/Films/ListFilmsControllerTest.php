<?php

namespace Tests\Feature\Controllers\Api\Cms\Films;


use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ListFilmsControllerTest extends TestCase
{

    use WithFaker;

    /**
     * @group api
     * @group films_api
     */
    public function testList()
    {

        $user = FilmGenerator::createAdminUser();
        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('api.films.index')
        )
            ->assertStatus(200);
        $response->assertJsonCount(2);
    }

    /**
     * @group api
     * @group films_api
     */
    public function testListReturn401IfNoUser()
    {

        $this->json(
            'GET',
            route('api.films.index')
        )
            ->assertStatus(401);;
    }

}
