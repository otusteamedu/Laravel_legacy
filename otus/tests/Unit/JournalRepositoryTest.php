<?php

namespace Tests\Unit;

use App\Models\Handbook;
use App\Models\Journal;
use App\Models\User;
use App\Services\Journals\Repositories\EloquentJournalsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JournalRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository = app()->make(EloquentJournalsRepository::class);

        $collection = factory(\App\Models\Journal::class, 1)->create();
        /** @var Journal $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository = app()->make(EloquentJournalsRepository::class);

        $count = Journal::all()->count();

        factory(\App\Models\Journal::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreJournalTableHasName() {

        $repository = app()->make(EloquentJournalsRepository::class);

        factory(Journal::class, 3)->create();

        $Journal = $this->createJournal();

        $repository->createFromArray($Journal);

        $this->assertDatabaseHas('journals', [
            'user_id' => $Journal['user_id']
        ]);
    }

    public function testStoreJournalCountIncrement() {
        $repository = app()->make(EloquentJournalsRepository::class);
        $count = Journal::all()->count();

        $Journal = $this->createJournal();
        $repository->createFromArray($Journal);

        $this->assertEquals($count + 1, Journal::all()->count());
    }

    public function testUpdateJournal() {
        $repository = app()->make(EloquentJournalsRepository::class);

        $collection = factory(\App\Models\Journal::class, 3)->create();
        /** @var Journal $item */
        $item = $collection->get(0);


        $repository->updateFromArray($item, [
            'user_id' => $item->user_id,
        ]);

        $this->assertDatabaseHas('journals', [
            'user_id' => $item->user_id
        ]);
    }

    public function testDeleteJournal() {
        $repository = app()->make(EloquentJournalsRepository::class);

        $collection = factory(\App\Models\Journal::class, 3)->create();
        $count = Journal::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

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
