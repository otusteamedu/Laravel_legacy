<?php

namespace Tests\Unit;

use App\Models\SelectionMaterial;
use App\Services\SelectionMaterials\SelectionMaterialsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SelectionMaterialServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(SelectionMaterialsService::class);

        $collection = factory(\App\Models\SelectionMaterial::class, 1)->create();
        /** @var SelectionMaterial $item */
        $item = $collection->get(0);

        $result = $service->findSelectionMaterial($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(SelectionMaterialsService::class);

        $count = SelectionMaterial::all()->count();

        factory(\App\Models\SelectionMaterial::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchSelectionMaterials();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreSelectionMaterialTableHasName() {

        $service = app()->make(SelectionMaterialsService::class);

        factory(SelectionMaterial::class, 3)->create();

        $selectionMaterials = $this->createSelectionMaterial();

        $service->storeSelectionMaterial($selectionMaterials);

        $this->assertDatabaseHas('selection_materials', [
            'name' => $selectionMaterials['name']
        ]);
    }

    public function testStoreSelectionMaterialCountIncrement() {
        $service = app()->make(SelectionMaterialsService::class);
        $count = SelectionMaterial::all()->count();

        $selectionMaterials = $this->createSelectionMaterial();
        $service->storeSelectionMaterial($selectionMaterials);

        $this->assertEquals($count + 1, SelectionMaterial::all()->count());
    }

    public function testUpdateSelectionMaterial() {
        $service = app()->make(SelectionMaterialsService::class);

        $collection = factory(\App\Models\SelectionMaterial::class, 3)->create();
        /** @var SelectionMaterial $item */
        $item = $collection->get(0);

        $service->updateSelectionMaterial($item, [
            'name' => $item->name,
        ]);

        $this->assertDatabaseHas('selection_materials', [
            'name' => $item->name
        ]);
    }

    public function testDeleteSelectionMaterial() {
        $service = app()->make(SelectionMaterialsService::class);

        $collection = factory(\App\Models\SelectionMaterial::class, 3)->create();
        $count = SelectionMaterial::all()->count();

        $item = $collection->get(0);

        $service->destroySelectionMaterial([$item->id]);

        $this->assertEquals($count - 1, SelectionMaterial::all()->count());
        $this->assertDatabaseMissing('selection_materials', [
            'id' => $item->id
        ]);
    }

    private function createSelectionMaterial() {
        return [
            'name' => $this->faker->name,
        ];
    }
}
