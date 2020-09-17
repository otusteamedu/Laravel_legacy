<?php

namespace Tests\Feature\Controllers\Api\Cms\Films;


use Mockery\Mock;
use Str;
use App\Models\Film;
use Laravel\Passport\Passport;
use Tests\Generators\FilmGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateFilmsControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @group api
     * @group films_api
     */
    public function testUpdateReturn401IfNoUser()
    {
        $film = FilmGenerator::createFilm();

        $data = [
            'title' => 'quidem',
        ];

        $this->json(
            'PATCH',
            route('films.update', [
                'film' => $film->id,
            ]),
            $data
        )->assertStatus(401);
    }



    /**
     * @group api
     * @group films_api
     */
    public function testUpdate()
    {
        $film = FilmGenerator::createFilm();
        $data = [
            'title' => 'quidem',
            'slug' => 'quidem'
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'PATCH',
            route('films.update', [
                'film' => $film->id,
            ]),
            $data
        )->assertStatus(200);

        $updatedFilm = $film->fresh();

        $this->assertEquals($data['title'], $updatedFilm->title);
    }

        
    /**
     * @group api
     * @group films_api
     */
    public function testUpdateWontUpdateWithExistingFilmName()
    {
        $film = FilmGenerator::createFilm();

        $data = [
            'title' => $film->title,
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'PATCH',
            route('films.update', [
                'film' => $film->id,
            ]),
            $data
        )->assertStatus(422);

        $updatedFilm = $film->fresh();
        $this->assertEquals($film->title, $updatedFilm->title);
    }

    /**
     * @group api
     * @group films_api
     */
    public function testUpdateFilmWithCurrentName()
    {
        $film = FilmGenerator::createFilm();

        $data = [
            'title' => $film->title,
            'slug' => 'sapiente',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'PATCH',
            route('films.update', [
                'film' => $film->id,
            ]),
            $data
        )->assertStatus(200);

        $updatedFilm = $film->fresh();
        $this->assertEquals($film->title, $film->title);
        $this->assertEquals($data['title'], $film->title);
    }

}
