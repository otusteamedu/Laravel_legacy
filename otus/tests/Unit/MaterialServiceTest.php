<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Handbook;
use App\Models\Material;
use App\Services\Materials\MaterialService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(MaterialService::class);

        $collection = factory(\App\Models\Material::class, 1)->create();
        /** @var Material $item */
        $item = $collection->get(0);

        $result = $service->findMaterial($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(MaterialService::class);

        $count = Material::all()->count();

        factory(\App\Models\Material::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchMaterials();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreMaterialTableHasName() {

        $service = app()->make(MaterialService::class);

        factory(Material::class, 3)->create();

        $material = $this->createMaterial();

        $service->storeMaterial($material);

        $this->assertDatabaseHas('materials', [
            'name' => $material['name']
        ]);
    }

    public function testStoreMaterialCountIncrement() {
        $service = app()->make(MaterialService::class);
        $count = Material::all()->count();

        $material = $this->createMaterial();
        $service->storeMaterial($material);

        $this->assertEquals($count + 1, Material::all()->count());
    }

    public function testUpdateMaterial() {
        $service = app()->make(MaterialService::class);

        $collection = factory(\App\Models\Material::class, 3)->create();
        /** @var Material $item */
        $item = $collection->get(0);

        $service->updateMaterial($item, [
            'name' => $item->name,
            'authors_id' => factory(\App\Models\Author::class, 1)->create()
        ]);

        $this->assertDatabaseHas('materials', [
            'name' => $item->name
        ]);
    }

    public function testDeleteMaterial() {
        $service = app()->make(MaterialService::class);

        $collection = factory(\App\Models\Material::class, 3)->create();
        $count = Material::all()->count();

        $item = $collection->get(0);

        $service->destroyMaterials([$item->id]);

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
