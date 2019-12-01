<?php

namespace Tests\Unit;

use App\Models\Handbook;
use App\Services\Handbooks\Repositories\EloquentHandbookRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HandbookRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository  = app()->make(EloquentHandbookRepository::class);

        $collection = factory(\App\Models\Handbook::class, 1)->create();
        /** @var Handbook $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository  = app()->make(EloquentHandbookRepository::class);

        $count = Handbook::all()->count();

        factory(\App\Models\Handbook::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreHandbookTableHasName() {

        $repository  = app()->make(EloquentHandbookRepository::class);

        factory(Handbook::class, 3)->create();

        $handbook = $this->createHandbook();


        $repository->createFromArray($handbook);

        $this->assertDatabaseHas('handbooks', [
            'name' => $handbook['name']
        ]);
    }

    public function testStoreHandbookCountIncrement() {
        $repository  = app()->make(EloquentHandbookRepository::class);
        $count = Handbook::all()->count();

        $handbook = $this->createHandbook();
        $repository->createFromArray($handbook);

        $this->assertEquals($count + 1, Handbook::all()->count());
    }

    public function testUpdateHandbook() {
        $repository  = app()->make(EloquentHandbookRepository::class);

        $collection = factory(\App\Models\Handbook::class, 3)->create();
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $repository->updateFromArray($item, [
            'name' => $name,
        ]);

        $this->assertDatabaseHas('handbooks', [
            'name' => $name
        ]);
    }

    public function testDeleteHandbook() {
        $repository  = app()->make(EloquentHandbookRepository::class);

        $collection = factory(\App\Models\Handbook::class, 3)->create();
        $count = Handbook::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

        $this->assertEquals($count - 1, Handbook::all()->count());
        $this->assertDatabaseMissing('handbooks', [
            'id' => $item->id
        ]);
    }

    private function createHandbook() {
        $date = new \DateTime();
        return [
            'code'=> 'HandbookCode_' . $date->getTimestamp(),
            'name' => 'HandbookName_' . $date->getTimestamp(),
            'description' => 'Test description'
        ];
    }
}
