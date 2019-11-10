<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Material;
use App\Models\SelectionMaterial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class SelectionMaterialsControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */

    public function testCreateSelectionMaterialIfInvalidNameParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.selection-materials.store'), [])
            ->assertSessionHasErrors();
    }


    public function testFailDeleteSelectionMaterial() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\SelectionMaterial::class, 1)->create();
        /** @var SelectionMaterial $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.selection-materials.destroy', ['selection_material' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreSelectionMaterial() {
        $user = UserGenerator::createEditorUser();
        $selectionMaterial = $this->createSelectionMaterial();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.selection-materials.store'), $selectionMaterial)
            ->assertStatus(301);

        $this->assertDatabaseHas('selection_materials', [
            'name' => $selectionMaterial['name']
        ]);
    }

    public function testCreatedOnlyOneSelectionMaterial() {
        $user = UserGenerator::createEditorUser();
        $selectionMaterial = $this->createSelectionMaterial();

        $count = SelectionMaterial::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.selection-materials.store'), $selectionMaterial)
            ->assertStatus(301);

        $this->assertEquals($count + 1, SelectionMaterial::all()->count());
    }

    public function testSuccessDeleteSelectionMaterial() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $collection */

        $count = SelectionMaterial::all()->count();

        $collection = factory(\App\Models\SelectionMaterial::class, 1)->create();
        /** @var SelectionMaterial $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.selection-materials.destroy', ['selection_material' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, SelectionMaterial::all()->count());
    }

    private function createSelectionMaterial() {
        return [
            'name' => $this->faker->name,
        ];
    }
}
