<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Compilation;
use App\Models\Material;
use App\Models\SelectionMaterial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CompilationControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */


    public function testCreateCompilationIfInvalidMaterialIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.compilations.store'), [
                'compilation_id' => factory(SelectionMaterial::class)->create()->id
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateCompilationIfInvalidCompilationIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.compilations.store'), [
                'material_id' => factory(Material::class)->create()->id,
            ])
            ->assertSessionHasErrors();
    }


    public function testFailStoreCompilation() {
        $user = UserGenerator::createSimpleUser();
        $compilation = $this->createCompilation();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.compilations.store'), $compilation)
            ->assertStatus(403);
    }

    public function testFailDeleteCompilation() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\Compilation::class, 1)->create();
        /** @var Compilation $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.compilations.destroy', ['compilation' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreCompilation() {
        $user = UserGenerator::createEditorUser();
        $compilation = $this->createCompilation();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.compilations.store'), $compilation)
            ->assertStatus(301);

        $this->assertDatabaseHas('compilations', [
            'material_id' => $compilation['material_id']
        ]);
    }

    public function testCreatedOnlyOneCompilation() {
        $user = UserGenerator::createEditorUser();
        $compilation = $this->createCompilation();

        $count = Compilation::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.compilations.store'), $compilation)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Compilation::all()->count());
    }

    public function testSuccessDeleteCompilation() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $collection */

        $count = Compilation::all()->count();

        $collection = factory(\App\Models\Compilation::class, 1)->create();
        /** @var Compilation $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.compilations.destroy', ['compilation' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Compilation::all()->count());
    }

    private function createCompilation() {
        return [
            'material_id' => factory(Material::class)->create()->id,
            'compilation_id' => factory(SelectionMaterial::class)->create()->id
        ];
    }
}
