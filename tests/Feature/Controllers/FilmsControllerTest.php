<?php

namespace Tests\Feature\Controllers;

//use App\Services\Films\Repositories\FilmRepositoryInterface;
use App\Models\Film;
use App\Services\Films\Repositories\FilmRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use Tests\Generators\FilmGenerator;
use Illuminate\Support\Str;
use Tests\Generators\UserGenerator;
use Tests\Generators\FilmGenerator;
use Tests\TestCase;

class FilmsControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getFilmRepository(): FilmRepositoryInterface
    {
        return app()->make(FilmRepositoryInterface::class);
    }

    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.films.index'))
            ->assertStatus(200);
    }

    /**
     * A Dusk test example.
     *
     * @group pages
     * @group cms
     * @return void
     */
    public function testCreate()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)->get(route('cms.films.create'))->assertStatus(200);
    }

    /**
     * A Dusk test example.
     *
     * @group pages
     * @return void
     */
    public function testCreateFilmFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.films.store'), [
                'name' => 'Test',
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Film::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group pages
     * @return void
     */
    public function testCreateFilmFailsIfParamsAreEmpty()
    {
        $this->createFilm([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Film::all()->count());
    }



    /**
     * A Dusk test example.
     *
     * @group pages
     * @return void
     */
    public function testCreateFilmWontCreateFilmWithTheSameName()
    {
        $data = $this->generateFilmCreateData();

        $this->createFilm($data);
        $this->createFilm($data);

        $this->assertEquals(1, Film::all()->count());
    }

    public function testUpdate()
    {
        $user = UserGenerator::createAdminUser();
        $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        $data = [
            'title' => $title,
            'meta_title'=> $title,
            'slug'=>Str::slug($title)
        ];
        $film = FilmGenerator::createFilm();

        $this->actingAs($user)->put(route('cms.films.update', [
                'film' => $film->id,
            ]), $data)->assertStatus(302);
    }


    public function testEdit()
    {
        $user = UserGenerator::createAdminUser();
        $film = FilmGenerator::createFilm();

        
        $this->actingAs($user)->get(
            route('cms.films.edit', [
                'film' => $film,
            ])
        )->assertStatus(200);
    }

    /**
     * Тест удаления страницы
     *
     * @return void
     */
    public function testDelete()
    {
        $user = UserGenerator::createAdminUser();
        $film = FilmGenerator::createFilm();

        $this->actingAs($user)->delete(route('cms.films.destroy', ['film' => $film]))->assertStatus(302);
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

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createFilm(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)->post(route('cms.films.store'), $data);
    }
}