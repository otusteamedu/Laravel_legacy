<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRepositoryTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $repository = app()->make(EloquentUserRepository::class);

        $collection = factory(\App\Models\User::class, 1)->create();
        /** @var User $item */
        $item = $collection->get(0);

        $result = $repository->find($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $repository = app()->make(EloquentUserRepository::class);

        $count = User::all()->count();

        factory(\App\Models\User::class, 3)->create();

        /** @var Collection $collection */

        $collection = $repository->search();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreUserTableHasName() {

        $repository = app()->make(EloquentUserRepository::class);

        factory(User::class, 3)->create();

        $users = $this->createUser();

        $repository->createFromArray($users);

        $this->assertDatabaseHas('users', [
            'name' => $users['name']
        ]);
    }

    public function testStoreUserCountIncrement() {
        $repository = app()->make(EloquentUserRepository::class);
        $count = User::all()->count();

        $users = $this->createUser();
        $repository->createFromArray($users);

        $this->assertEquals($count + 1, User::all()->count());
    }

    public function testUpdateUser() {
        $repository = app()->make(EloquentUserRepository::class);

        $collection = factory(\App\Models\User::class, 3)->create();
        /** @var User $item */
        $item = $collection->get(0);

        $repository->updateFromArray($item, [
            'name' => $item->name,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $item->name
        ]);
    }

    public function testDeleteUser() {
        $repository = app()->make(EloquentUserRepository::class);

        $collection = factory(\App\Models\User::class, 3)->create();
        $count = User::all()->count();

        $item = $collection->get(0);

        $repository->destroy([$item->id]);

        $this->assertEquals($count - 1, User::all()->count());
        $this->assertDatabaseMissing('users', [
            'id' => $item->id
        ]);
    }

    private function createUser() {

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->md5,
            'photo' => null,
            'role' => null
        ];
    }
}
