<?php

namespace Tests\Feature\Controllers;

//use App\Services\Films\Repositories\FilmRepositoryInterface;
use App\Models\Page;
use App\Services\Pages\Repositories\PageRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use Tests\Generators\FilmGenerator;
use Illuminate\Support\Str;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PagesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getPageRepository(): PageRepositoryInterface
    {
        return app()->make(PageRepositoryInterface::class);
    }

    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        //dd($user);
        $this->actingAs($user)
            ->get(route('cms.films.index'))
            ->assertStatus(200);
    }

    /**
     * A Dusk test example.
     *
     * @group films
     * @group cms
     * @return void
     */
    public function testCreatePage()
    {
        $data = $this->generatePageCreateData();
        //тк после создания фильма редирект на список фильмов
        //то указал здесь 302 редирект
        //dd($data);
        $this->createPage($data)->assertStatus(302);
        $this->assertDatabaseHas('pages', [
            'title' => $data['title'],
        ]);
        $this->assertNotNull(Page::where('title', $data['title'])->first());
    }

    /**
     * @return array
     */
    private function generatePageCreateData(): array
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
    private function createPage(array $data)
    {
        $user = UserGenerator::createAdminUser();
        //dd($user);
        //
        return $this->actingAs($user)->post(route('cms.pages.store'), $data);
    }
}
