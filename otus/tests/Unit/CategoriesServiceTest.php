<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\Categories\CategoryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(CategoryService::class);

        $collection = factory(\App\Models\Category::class, 1)->create();
        /** @var Category $item */
        $item = $collection->get(0);

        $result = $service->findCategory($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(CategoryService::class);

        $count = Category::all()->count();

        factory(\App\Models\Category::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchCategories();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreCategoryTableHasName() {

        $service = app()->make(CategoryService::class);

        $count = Category::all()->count();

        factory(\App\Models\Category::class, 3)->create();

        $category = $this->createCategory();

        $service->storeCategory($category);

        $this->assertDatabaseHas('categories', [
            'name' => $category['name']
        ]);
    }

    public function testStoreCategoryCountIncrement() {
        $service = app()->make(CategoryService::class);
        $count = Category::all()->count();

        $category = $this->createCategory();
        $service->storeCategory($category);

        $this->assertEquals($count + 1, Category::all()->count());
    }

    public function testUpdateCategory() {
        $service = app()->make(CategoryService::class);

        $collection = factory(\App\Models\Category::class, 3)->create();
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $service->updateCategory($item, [
            'name' => $name
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => $name
        ]);
    }

    public function testDeleteCategory() {
        $service = app()->make(CategoryService::class);

        $collection = factory(\App\Models\Category::class, 3)->create();
        $count = Category::all()->count();

        $item = $collection->get(0);

        $service->destroyCategories([$item->id]);

        $this->assertEquals($count - 1, Category::all()->count());
        $this->assertDatabaseMissing('categories', [
            'id' => $item->id
        ]);
    }

    private function createCategory() {
        return [
            'name' => $this->faker->name,
        ];
    }
}
