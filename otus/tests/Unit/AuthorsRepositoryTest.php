<?php

namespace Tests\Unit;

use App\Models\Author;

use App\Services\Authors\Repositories\EloquentAuthorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorsRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group repositories
     */
    public function testFindItemById() {
        $repository = app()->make(EloquentAuthorRepository::class);

        $collection = factory(\App\Models\Author::class, 1)->create();
        /** @var Author $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository  = app()->make(EloquentAuthorRepository::class);

        $count = Author::all()->count();

        factory(\App\Models\Author::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreAuthorTableHasName() {

        $repository  = app()->make(EloquentAuthorRepository::class);

        $count = Author::all()->count();

        factory(\App\Models\Author::class, 3)->create();

        $author = $this->createAuthor();

        $repository->createFromArray($author);

        $this->assertDatabaseHas('authors', [
            'name' => $author['name']
        ]);
    }

    public function testStoreAuthorCountIncrement() {
        $repository  = app()->make(EloquentAuthorRepository::class);
        $count = Author::all()->count();

        $author = $this->createAuthor();
        $repository->createFromArray($author);

        $this->assertEquals($count + 1, Author::all()->count());
    }

    public function testUpdateAuthor() {
        $repository  = app()->make(EloquentAuthorRepository::class);

        $collection = factory(\App\Models\Author::class, 3)->create();
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $repository->updateFromArray($item, [
            'name' => $name
        ]);

        $this->assertDatabaseHas('authors', [
            'name' => $name
        ]);
    }

    public function testDeleteAuthor() {
        $repository  = app()->make(EloquentAuthorRepository::class);

        $collection = factory(\App\Models\Author::class, 3)->create();
        $count = Author::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

        $this->assertEquals($count - 1, Author::all()->count());
        $this->assertDatabaseMissing('authors', [
            'id' => $item->id
        ]);
    }

    private function createAuthor() {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            '_token' => csrf_token()
        ];
    }
}
