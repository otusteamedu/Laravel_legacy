<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Favorite;
use App\Models\Material;
use App\Models\SelectionMaterial;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class FavoritesControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */


    public function testCreateFavoriteIfInvalidMaterialIdParam() {

        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.favorites.store'), [
                'user_id' => factory(SelectionMaterial::class)->create()->id
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateFavoriteIfInvalidUserIdParam() {

        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.favorites.store'), [
                'material_id' =>  factory(Material::class)->create()->id
            ])
            ->assertSessionHasErrors();
    }

    public function testFailStoreFavorite() {
        $user = UserGenerator::createSimpleUser();
        $favorite = $this->createFavorite();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.favorites.store'), $favorite)
            ->assertStatus(301);
    }

    public function testFailDeleteFavorite() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\Favorite::class, 1)->create();
        /** @var Favorite $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.favorites.destroy', ['favorite' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreFavorite() {
        $user = UserGenerator::createEditorUser();
        $favorite = $this->createFavorite();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.favorites.store'), $favorite)
            ->assertStatus(301);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $favorite['user_id']
        ]);
    }

    public function testCreatedOnlyOneFavorite() {
        $user = UserGenerator::createEditorUser();
        $favorite = $this->createFavorite();

        $count = Favorite::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.favorites.store'), $favorite)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Favorite::all()->count());
    }

    public function testSuccessDeleteFavorite() {

        $count = Favorite::all()->count();

        $collection = factory(\App\Models\Favorite::class, 1)->create();
        /** @var Favorite $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $user = User::find($item->user_id);

        $this->actingAs($user)
            ->delete(route('admin.favorites.destroy', ['favorite' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Favorite::all()->count());
    }

    private function createFavorite() {
        return [
            'user_id' => factory(User::class)->create()->id,
            'material_id' =>  factory(Material::class)->create()->id
        ];
    }
}
