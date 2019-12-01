<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\Categories\Repositories\EloquentCategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesRepositoryTest extends TestCase {
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository = app()->make(EloquentCategoryRepository::class);

        $collection = factory(\App\Models\Category::class, 1)->create();
        /** @var Category $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository = app()->make(EloquentCategoryRepository::class);

        $count = Category::all()->count();

        factory(\App\Models\Category::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreCategoryTableHasName() {

        $repository = app()->make(EloquentCategoryRepository::class);

        $count = Category::all()->count();

        factory(\App\Models\Category::class, 3)->create();

        $category = $this->createCategory();

        $repository->createFromArray($category);

        $this->assertDatabaseHas('categories', [
            'name' => $category['name']
        ]);
    }

    public function testStoreCategoryCountIncrement() {
        $repository = app()->make(EloquentCategoryRepository::class);
        $count = Category::all()->count();

        $category = $this->createCategory();
        $repository->createFromArray($category);

        $this->assertEquals($count + 1, Category::all()->count());
    }

    public function testUpdateCategory() {
        $repository = app()->make(EloquentCategoryRepository::class);

        $collection = factory(\App\Models\Category::class, 3)->create();
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $repository->updateFromArray($item, [
            'name' => $name
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => $name
        ]);
    }

    public function testDeleteCategory() {
        $repository = app()->make(EloquentCategoryRepository::class);

        $collection = factory(\App\Models\Category::class, 3)->create();
        $count = Category::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

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
