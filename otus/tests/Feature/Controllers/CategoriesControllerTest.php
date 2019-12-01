<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */


    public function testCreateCategoryIfInvalidNameParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.categories.store'), [])
            ->assertSessionHasErrors();
    }


    public function testFailStoreCategory() {
        $user = UserGenerator::createSimpleUser();
        $category = $this->createCategory();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.categories.store'), $category)
            ->assertStatus(403);
    }

    public function testFailDeleteCategory() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $categorysCollection */

        $collection = factory(\App\Models\Category::class, 1)->create();
        /** @var Category $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.categories.destroy', ['category' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreCategory() {
        $user = UserGenerator::createEditorUser();
        $category = $this->createCategory();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.categories.store'), $category)
            ->assertStatus(301);

        $this->assertDatabaseHas('categories', [
            'name' => $category['name']
        ]);
    }

    public function testCreatedOnlyOneCategory() {
        $user = UserGenerator::createEditorUser();
        $category = $this->createCategory();

        $count = Category::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.categories.store'), $category)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Category::all()->count());
    }

    public function testSuccessDeleteCategory() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $categorysCollection */

        $count = Category::all()->count();

        $collection = factory(\App\Models\Category::class, 1)->create();
        /** @var Category $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.categories.destroy', ['category' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Category::all()->count());
    }

    private function createCategory() {
        return [
            'name' => $this->faker->name,
        ];
    }
}
