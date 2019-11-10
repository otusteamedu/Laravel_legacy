<?php

namespace Tests\Unit;

use App\Models\Handbook;
use App\Models\Journal;
use App\Models\User;
use App\Services\Journals\JournalService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JournalServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(JournalService::class);

        $collection = factory(\App\Models\Journal::class, 1)->create();
        /** @var Journal $item */
        $item = $collection->get(0);

        $result = $service->findJournal($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(JournalService::class);

        $count = Journal::all()->count();

        factory(\App\Models\Journal::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchJournals();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreJournalTableHasName() {

        $service = app()->make(JournalService::class);

        factory(Journal::class, 3)->create();

        $Journal = $this->createJournal();

        $service->storeJournal($Journal);

        $this->assertDatabaseHas('journals', [
            'user_id' => $Journal['user_id']
        ]);
    }

    public function testStoreJournalCountIncrement() {
        $service = app()->make(JournalService::class);
        $count = Journal::all()->count();

        $Journal = $this->createJournal();
        $service->storeJournal($Journal);

        $this->assertEquals($count + 1, Journal::all()->count());
    }

    public function testUpdateJournal() {
        $service = app()->make(JournalService::class);

        $collection = factory(\App\Models\Journal::class, 3)->create();
        /** @var Journal $item */
        $item = $collection->get(0);


        $service->updateJournal($item, [
            'user_id' => $item->user_id,
        ]);

        $this->assertDatabaseHas('journals', [
            'user_id' => $item->user_id
        ]);
    }

    public function testDeleteJournal() {
        $service = app()->make(JournalService::class);

        $collection = factory(\App\Models\Journal::class, 3)->create();
        $count = Journal::all()->count();

        $item = $collection->get(0);

        $service->destroyJournal([$item->id]);

        $this->assertEquals($count - 1, Journal::all()->count());
        $this->assertDatabaseMissing('journals', [
            'id' => $item->id
        ]);
    }

    private function createJournal() {
        return [
            'user_id' => factory(User::class)->create()->id,
            'status_id' => factory(Handbook::class)->create()->id
        ];
    }
}
