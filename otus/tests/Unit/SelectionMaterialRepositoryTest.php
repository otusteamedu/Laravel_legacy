<?php

namespace Tests\Unit;

use App\Models\SelectionMaterial;
use App\Services\SelectionMaterials\Repositories\EloquentSelectionMaterialsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SelectionMaterialRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository = app()->make(EloquentSelectionMaterialsRepository::class);

        $collection = factory(\App\Models\SelectionMaterial::class, 1)->create();
        /** @var SelectionMaterial $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository = app()->make(EloquentSelectionMaterialsRepository::class);

        $count = SelectionMaterial::all()->count();

        factory(\App\Models\SelectionMaterial::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreSelectionMaterialTableHasName() {

        $repository = app()->make(EloquentSelectionMaterialsRepository::class);

        factory(SelectionMaterial::class, 3)->create();

        $selectionMaterials = $this->createSelectionMaterial();

        $repository->createFromArray($selectionMaterials);

        $this->assertDatabaseHas('selection_materials', [
            'name' => $selectionMaterials['name']
        ]);
    }

    public function testStoreSelectionMaterialCountIncrement() {
        $repository = app()->make(EloquentSelectionMaterialsRepository::class);
        $count = SelectionMaterial::all()->count();

        $selectionMaterials = $this->createSelectionMaterial();
        $repository->createFromArray($selectionMaterials);

        $this->assertEquals($count + 1, SelectionMaterial::all()->count());
    }

    public function testUpdateSelectionMaterial() {
        $repository = app()->make(EloquentSelectionMaterialsRepository::class);

        $collection = factory(\App\Models\SelectionMaterial::class, 3)->create();
        /** @var SelectionMaterial $item */
        $item = $collection->get(0);

        $repository->updateFromArray($item, [
            'name' => $item->name,
        ]);

        $this->assertDatabaseHas('selection_materials', [
            'name' => $item->name
        ]);
    }

    public function testDeleteSelectionMaterial() {
        $repository = app()->make(EloquentSelectionMaterialsRepository::class);

        $collection = factory(\App\Models\SelectionMaterial::class, 3)->create();
        $count = SelectionMaterial::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

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
