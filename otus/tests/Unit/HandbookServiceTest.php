<?php

namespace Tests\Unit;

use App\Models\Handbook;
use App\Services\Handbooks\HandbookService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HandbookServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service  = app()->make(HandbookService::class);

        $collection = factory(\App\Models\Handbook::class, 1)->create();
        /** @var Handbook $item */
        $item = $collection->get(0);

        $result = $service->findHandbook($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service  = app()->make(HandbookService::class);

        $count = Handbook::all()->count();

        factory(\App\Models\Handbook::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchHandbooks();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreHandbookTableHasName() {

        $service  = app()->make(HandbookService::class);

        factory(Handbook::class, 3)->create();

        $handbook = $this->createHandbook();


        $service->storeHandbook($handbook);

        $this->assertDatabaseHas('handbooks', [
            'name' => $handbook['name']
        ]);
    }

    public function testStoreHandbookCountIncrement() {
        $service  = app()->make(HandbookService::class);
        $count = Handbook::all()->count();

        $handbook = $this->createHandbook();
        $service->storeHandbook($handbook);

        $this->assertEquals($count + 1, Handbook::all()->count());
    }

    public function testUpdateHandbook() {
        $service  = app()->make(HandbookService::class);

        $collection = factory(\App\Models\Handbook::class, 3)->create();
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $service->updateHandbook($item, [
            'name' => $name,
        ]);

        $this->assertDatabaseHas('handbooks', [
            'name' => $name
        ]);
    }

    public function testDeleteHandbook() {
        $service  = app()->make(HandbookService::class);

        $collection = factory(\App\Models\Handbook::class, 3)->create();
        $count = Handbook::all()->count();

        $item = $collection->get(0);

        $service->destroyHandbook([$item->id]);

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
