<?php

namespace Tests\Unit;

use App\Models\Compilation;
use App\Models\Favorite;
use App\Models\Material;
use App\Models\User;
use App\Services\Favorites\Repositories\EloquentFavoriteRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository  = app()->make(EloquentFavoriteRepository::class);

        $collection = factory(\App\Models\Favorite::class, 1)->create();
        /** @var Favorite $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository  = app()->make(EloquentFavoriteRepository::class);

        $count = Favorite::all()->count();

        factory(\App\Models\Favorite::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreFavoriteTableHasName() {

        $repository  = app()->make(EloquentFavoriteRepository::class);

        $count = Favorite::all()->count();

        factory(\App\Models\Favorite::class, 3)->create();

        $favorite = $this->createFavorite();

        /** @var Compilation $element */
        $element = $repository->createFromArray($favorite);


        $this->assertDatabaseHas('favorites', [
            'material_id' => $element->material_id
        ]);
    }

    public function testStoreFavoriteCountIncrement() {
        $repository  = app()->make(EloquentFavoriteRepository::class);
        $count = Favorite::all()->count();

        $favorite = $this->createFavorite();
        $repository->createFromArray($favorite);

        $this->assertEquals($count + 1, Favorite::all()->count());
    }

    public function testUpdateFavorite() {
        $repository  = app()->make(EloquentFavoriteRepository::class);

        $collection = factory(\App\Models\Favorite::class, 3)->create();
        /** @var Favorite $item */
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $repository->updateFromArray($item, [
            'material_id' => $item->material_id
        ]);

        $this->assertDatabaseHas('favorites', [
            'material_id' => $item->material_id
        ]);
    }

    public function testDeleteFavorite() {
        $repository  = app()->make(EloquentFavoriteRepository::class);

        $collection = factory(\App\Models\Favorite::class, 3)->create();
        $count = Favorite::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

        $this->assertEquals($count - 1, Favorite::all()->count());
        $this->assertDatabaseMissing('favorites', [
            'id' => $item->id
        ]);
    }

    private function createFavorite() {
        return [
            'user_id' => factory(User::class)->create()->id,
            'material_id' =>  factory(Material::class)->create()->id
        ];
    }
}
