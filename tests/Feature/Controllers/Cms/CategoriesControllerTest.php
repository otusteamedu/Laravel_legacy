<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\Category;
use App\Services\Categories\Repositories\CategoryRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\CategoryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getCategoryRepository(): CategoryRepositoryInterface
    {
        return app()->make(CategoryRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group categories
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.categories.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group categories
     * @group testIndexWithCategories
     */
    public function testIndexWithCategories()
    {
        $category = CategoryGenerator::createMoscow();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.categories.index'))
            ->assertStatus(200)
            ->assertSeeText($category->name);
    }

    /**
     * @group cms
     * @group categories
     * @group testUnAuthicatedUserWontCreateCategoryAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateCategoryAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateCategoryCreateData();
        $this->post(route('cms.categories.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group categories
     * @group testCreateCategory
     * @return void
     */
    public function testCreateCategory()
    {
        $data = $this->generateCategoryCreateData();
        $this->createCategory($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('categories', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(Category::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group categories
     * @group testCreateCategoryFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateCategoryFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.categories.store'), [
                'country_id' => function(){
                    return factory(App\Models\Country::class)->create()->id;
                },
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Category::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group categories
     * @group testCreateCategoryFailsIfNameIsEmpty
     * @return void
     */

    public function testCreateCategoryFailsIfCountryIdIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.categories.store'), [
                'name' => $this->faker->text(20),
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Category::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group categories
     * @group testCreateCategoryFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateCategoryFailsIfParamsAreEmpty()
    {
        $this->createCategory([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Category::all()->count());
    }

    /**
     * @return array
     */
    private function generateCategoryCreateData(): array
    {
        return [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text,
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createCategory(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.categories.store'), $data);
    }

}
