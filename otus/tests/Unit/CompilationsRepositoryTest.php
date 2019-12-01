<?php

namespace Tests\Unit;

use App\Models\Compilation;
use App\Models\Material;
use App\Models\SelectionMaterial;
use App\Services\Compilations\Repositories\EloquentCompilationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompilationsRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository = app()->make(EloquentCompilationRepository::class);

        $collection = factory(\App\Models\Compilation::class, 1)->create();
        /** @var Compilation $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository = app()->make(EloquentCompilationRepository::class);

        $count = Compilation::all()->count();

        factory(\App\Models\Compilation::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreCompilationTableHasName() {

        $repository = app()->make(EloquentCompilationRepository::class);

        $count = Compilation::all()->count();

        factory(\App\Models\Compilation::class, 3)->create();

        $compilation = $this->createCompilation();

        /** @var Compilation $element */
        $element = $repository->createFromArray($compilation);

        $this->assertDatabaseHas('compilations', [
            'material_id' => $element->material_id
        ]);
    }

    public function testStoreCompilationCountIncrement() {
        $repository = app()->make(EloquentCompilationRepository::class);
        $count = Compilation::all()->count();

        $compilation = $this->createCompilation();
        $repository->createFromArray($compilation);

        $this->assertEquals($count + 1, Compilation::all()->count());
    }

    public function testUpdateCompilation() {
        $repository = app()->make(EloquentCompilationRepository::class);

        $collection = factory(\App\Models\Compilation::class, 3)->create();
        /** @var Compilation $item */
        $item = $collection->get(0);

        $newMaterialId = factory(Material::class)->create()->id;

        $repository->updateFromArray($item, [
            'material_id' => $newMaterialId
        ]);

        $this->assertDatabaseHas('compilations', [
            'material_id' => $newMaterialId
        ]);
    }

    public function testDeleteCompilation() {
        $repository = app()->make(EloquentCompilationRepository::class);

        $collection = factory(\App\Models\Compilation::class, 3)->create();
        $count = Compilation::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

        $this->assertEquals($count - 1, Compilation::all()->count());
        $this->assertDatabaseMissing('compilations', [
            'id' => $item->id
        ]);
    }

    private function createCompilation() {

        return [
            'material_id' => factory(Material::class)->create()->id,
            'compilation_id' => factory(SelectionMaterial::class)->create()->id
        ];
    }
}
