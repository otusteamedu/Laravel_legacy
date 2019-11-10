<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Services\Authors\AuthorsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorsServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service  = app()->make(AuthorsService::class);

        $collection = factory(\App\Models\Author::class, 1)->create();
        /** @var Author $item */
        $item = $collection->get(0);

        $result = $service->findAuthor($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service  = app()->make(AuthorsService::class);

        $count = Author::all()->count();

        factory(\App\Models\Author::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchAuthors();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreAuthorTableHasName() {

        $service  = app()->make(AuthorsService::class);

        $count = Author::all()->count();

        factory(\App\Models\Author::class, 3)->create();

        $author = $this->createAuthor();

        $service->storeAuthor($author);

        $this->assertDatabaseHas('authors', [
            'name' => $author['name']
        ]);
    }

    public function testStoreAuthorCountIncrement() {
        $service  = app()->make(AuthorsService::class);
        $count = Author::all()->count();

        $author = $this->createAuthor();
        $service->storeAuthor($author);

        $this->assertEquals($count + 1, Author::all()->count());
    }

    public function testUpdateAuthor() {
        $service  = app()->make(AuthorsService::class);

        $collection = factory(\App\Models\Author::class, 3)->create();
        $item = $collection->get(0);

        $date = new \DateTime();
        $name = 'test service update entity' . $date->getTimestamp();

        $service->updateAuthor($item, [
            'name' => $name
        ]);

        $this->assertDatabaseHas('authors', [
            'name' => $name
        ]);
    }

    public function testDeleteAuthor() {
        $service  = app()->make(AuthorsService::class);

        $collection = factory(\App\Models\Author::class, 3)->create();
        $count = Author::all()->count();

        $item = $collection->get(0);

        $service->destroyAuthors([$item->id]);

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
