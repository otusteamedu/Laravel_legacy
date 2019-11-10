<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Handbook;
use App\Models\Material;
use App\Services\Materials\Repositories\EloquentMaterialRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository = app()->make(EloquentMaterialRepository::class);

        $collection = factory(\App\Models\Material::class, 1)->create();
        /** @var Material $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository = app()->make(EloquentMaterialRepository::class);

        $count = Material::all()->count();

        factory(\App\Models\Material::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreMaterialTableHasName() {

        $repository = app()->make(EloquentMaterialRepository::class);

        factory(Material::class, 3)->create();

        $material = $this->createMaterial();

        $repository->createFromArray($material);

        $this->assertDatabaseHas('materials', [
            'name' => $material['name']
        ]);
    }

    public function testStoreMaterialCountIncrement() {
        $repository = app()->make(EloquentMaterialRepository::class);
        $count = Material::all()->count();

        $material = $this->createMaterial();
        $repository->createFromArray($material);

        $this->assertEquals($count + 1, Material::all()->count());
    }

    public function testUpdateMaterial() {
        $repository = app()->make(EloquentMaterialRepository::class);

        $collection = factory(\App\Models\Material::class, 3)->create();
        /** @var Material $item */
        $item = $collection->get(0);

        $repository->updateFromArray($item, [
            'name' => $item->name,
            'authors_id' => factory(\App\Models\Author::class, 1)->create()
        ]);

        $this->assertDatabaseHas('materials', [
            'name' => $item->name
        ]);
    }

    public function testDeleteMaterial() {
        $repository = app()->make(EloquentMaterialRepository::class);

        $collection = factory(\App\Models\Material::class, 3)->create();
        $count = Material::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

        $this->assertEquals($count - 1, Material::all()->count());
        $this->assertDatabaseMissing('materials', [
            'id' => $item->id
        ]);
    }

    private function createMaterial() {
        $date = new \DateTime();
        return [
            'name' => 'Material_test_name_' . $date->getTimestamp(),
            'category_id' =>  factory(Category::class)->create()->id,
            'status_id' =>  factory(Handbook::class)->create()->id,

            'file' =>  public_path() . $date->getTimestamp() . '.jpg',
            'year_publishing' => $this->faker->numberBetween(1980, 2019),
            'authors_id' => factory(\App\Models\Author::class, 1)->create()
        ];
    }
}
