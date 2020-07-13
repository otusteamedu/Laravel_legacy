<?php

namespace Tests\Feature\Controllers;

//use App\Services\Films\Repositories\FilmRepositoryInterface;
use App\Models\Page;
use App\Services\Pages\Repositories\PageRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\Generators\UserGenerator;
use Tests\Generators\PageGenerator;
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
        $this->actingAs($user)
            ->get(route('cms.pages.index'))
            ->assertStatus(200);
    }

    /**
     * Тест по созданию страницы.
     *
     * @group pages
     * @group cms
     * @return void
     */
    public function testCreate()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)->get(route('cms.pages.create'))->assertStatus(200);
    }

    /**
     * Тест по созданию страницы с пустым name
     *
     * @group pages
     * @return void
     */
    public function testCreatePageFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.pages.store'), [
                'name' => 'Test',
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Page::all()->count());
    }

    /**
     * Тест по созданию страницы с пустыми параметрами
     *
     * @group pages
     * @return void
     */
    public function testCreatePageFailsIfParamsAreEmpty()
    {
        $this->createPage([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Page::all()->count());
    }



    /**
     * Тест по созданию страницы с случайным именем
     *
     * @group pages
     * @return void
     */
    public function testCreatePageWontCreatePageWithTheSameName()
    {
        $data = $this->generatePageCreateData();

        $this->createPage($data);
        $this->createPage($data);

        $this->assertEquals(2, Page::all()->count());
    }
    /**
     * Тест по обновлению страницы
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
        $page = PageGenerator::createPage();

        $this->actingAs($user)->put(route('cms.pages.update', [
                'page' => $page->id,
            ]), $data)->assertStatus(302);
    }
    /**
     * Тест по редактированию страницы
     *
     * @group films
     * @return void
     */
    public function testEdit()
    {
        $user = UserGenerator::createAdminUser();
        $page = PageGenerator::createPage();

        
        $this->actingAs($user)->get(
            route('cms.pages.edit', [
                'page' => $page,
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
        $page = PageGenerator::createPage();

        $this->actingAs($user)->delete(route('cms.pages.destroy', ['page' => $page]))->assertStatus(302);
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
            'meta_keywords' => $title,
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
        return $this->actingAs($user)->post(route('cms.pages.store'), $data);
    }
}