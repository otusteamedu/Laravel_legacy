<?php

namespace Tests\Unit;

use App\Models\Compilation;
use App\Models\Material;
use App\Models\SelectionMaterial;
use App\Services\Compilations\CompilationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompilationsServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(CompilationService::class);

        $collection = factory(\App\Models\Compilation::class, 1)->create();
        /** @var Compilation $item */
        $item = $collection->get(0);

        $result = $service->findCompilation($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(CompilationService::class);

        $count = Compilation::all()->count();

        factory(\App\Models\Compilation::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchCompilations();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreCompilationTableHasName() {

        $service = app()->make(CompilationService::class);

        $count = Compilation::all()->count();

        factory(\App\Models\Compilation::class, 3)->create();

        $compilation = $this->createCompilation();

        /** @var Compilation $element */
        $element = $service->storeCompilation($compilation);

        $this->assertDatabaseHas('compilations', [
            'material_id' => $element->material_id
        ]);
    }

    public function testStoreCompilationCountIncrement() {
        $service = app()->make(CompilationService::class);
        $count = Compilation::all()->count();

        $compilation = $this->createCompilation();
        $service->storeCompilation($compilation);

        $this->assertEquals($count + 1, Compilation::all()->count());
    }

    public function testUpdateCompilation() {
        $service = app()->make(CompilationService::class);

        $collection = factory(\App\Models\Compilation::class, 3)->create();
        /** @var Compilation $item */
        $item = $collection->get(0);

        $service->updateCompilation($item, [
            'material_id' => $item->material_id
        ]);

        $this->assertDatabaseHas('compilations', [
            'material_id' => $item->material_id
        ]);
    }

    public function testDeleteCompilation() {
        $service = app()->make(CompilationService::class);

        $collection = factory(\App\Models\Compilation::class, 3)->create();
        $count = Compilation::all()->count();

        $item = $collection->get(0);

        $service->destroyCompilation([$item->id]);

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
