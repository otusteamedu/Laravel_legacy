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

class StoreFilmsControllerTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    /**
     * @group api
     * @group films_api
     */
    public function testStoreReturn401IfNoUser()
    {
        $data = $this->generateFilmCreateData();

        $this->json(
            'POST',
            route('films.store'),
            $data
        )->assertStatus(401);
    }

    /**
     * @group api
     * @group films_api
     */
    public function testStoreReturn422IfNoName()
    {
        $data = [
            'title' => 'Test',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('films.store'),
            $data
        )->assertStatus(422);
    }


    /**
     * @group api
     * @group films_api
     */
    public function testStoreReturn422IfNoFilm()
    {
        $data = [
            'title' => 'quidem',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('films.store'),
            $data
        )->assertStatus(422);
    }

    /**
     * @group api
     * @group films_api
     */
    public function testStoreReturn422IfNoFilmAlreadyExists()
    {
        $film = FilmGenerator::createFilm();
        $data = [
            'title' => $film->title,
            'slug' => $film->slug,
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('films.store'),
            $data
        )->assertStatus(422);

        $this->assertEquals(1, Film::count());
    }


      /**
     * @return array
     */
    private function generateFilmCreateData(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-3 months', '-2 months');
        $title = $this->faker->word;

        return [
            'title' => $title,
            'meta_title' => $title,
            'meta_description' => $title,
            'keywords' => $title,
            'slug' => Str::slug($title),
            'status' => "Опубликовано",
            'content' => $this->faker->sentence(20),
            'year' => $this->faker->year,
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween('-2 months', '-1 months'),
        ];
    }

}
