<?php

namespace Tests\Feature\Controllers;

use App\Models\Film;
use App\Services\Films\Repositories\FilmRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            ->get(route('cms.films.index',[
                'locale' => config('app.locale'),
            ]))
            ->assertStatus(200);
    }

    /**
     * Тест по созданию фильма
     *
     * @group pages
     * @group cms
     * @return void
     */
    public function testCreateFilm()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)->get(route('cms.films.create',[
            'locale' => config('app.locale'),
        ]))->assertStatus(200);
    }

    /**
     * Тест по созданию фильма с пустым name
     *
     * @group pages
     * @return void
     */
    public function testCreateFilmFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->createFilm([
            'name' => '',
        ])->assertSessionHasErrors();


        $this->assertEquals(0, Film::all()->count());
    }

    /**
     * Тест по созданию фильма с пустыми параметрами
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
     * Тест по созданию фильма с случайным именем
     *
     * @group films
     * @return void
     */
    public function testCreateFilmWontCreateFilmWithTheSameName()
    {
        $data = $this->generateFilmCreateData();

        $this->createFilm($data);
        $this->createFilm($data);

        $this->assertEquals(1, Film::all()->count());
    }
    /**
     * Тест по обновлению фильма
     *
     * @group films
     * @return void
     */
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
                'locale' => config('app.locale')
        ]), $data)->assertStatus(302);
    }
    /**
     * Тест по редактированию фильма
     *
     * @group films
     * @return void
     */
    public function testEdit()
    {
        $user = UserGenerator::createAdminUser();
        $film = FilmGenerator::createFilm();

        $this->actingAs($user)->get(
            route('cms.films.edit', [
                'film' => $film,
                'locale' => config('app.locale')
            ])
        )->assertStatus(200);
    }

    /**
     * Тест удаления страницы
     *
     * @group films
     * @return void
     */
    public function testDelete()
    {
        $user = UserGenerator::createAdminUser();
        $film = FilmGenerator::createFilm();
        $this->actingAs($user)->delete(route('cms.films.destroy', ['film' => $film, 'locale' => config('app.locale')]))->assertStatus(302);
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
        return $this->actingAs($user)->post(route('cms.films.store',[
            'locale' => config('app.locale'),
        ]), $data);
    }
}