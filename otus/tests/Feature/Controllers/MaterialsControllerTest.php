<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Category;
use App\Models\Handbook;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class MaterialsControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */

    public function testCreateMaterialIfInvalidNameParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.materials.store'), [
                'category_id' =>  factory(Category::class)->create()->id,
                'status_id' =>  factory(Handbook::class)->create()->id,
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateMaterialIfInvalidStatusIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.materials.store'), [
                'category_id' =>  factory(Category::class)->create()->id,
                'name' =>  'test',
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateMaterialIfInvalidCategoryIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.materials.store'), [
                'status_id' =>  factory(Handbook::class)->create()->id,
                'name' =>  'test',
            ])
            ->assertSessionHasErrors();
    }

    public function testFailDeleteMaterial() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\Material::class, 1)->create();
        /** @var Material $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.materials.destroy', ['material' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreMaterial() {
        $user = UserGenerator::createEditorUser();
        $material = $this->createMaterial();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.materials.store'), $material)
            ->assertStatus(301);

        $this->assertDatabaseHas('materials', [
            'name' => $material['name']
        ]);
    }

    public function testCreatedOnlyOneMaterial() {
        $user = UserGenerator::createEditorUser();
        $material = $this->createMaterial();

        $count = Material::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.materials.store'), $material)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Material::all()->count());
    }

    public function testSuccessDeleteMaterial() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $collection */

        $count = Material::all()->count();

        $collection = factory(\App\Models\Material::class, 1)->create();
        /** @var Material $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.materials.destroy', ['material' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Material::all()->count());
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
