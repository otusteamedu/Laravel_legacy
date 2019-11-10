<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\Users\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(UserService::class);

        $collection = factory(\App\Models\User::class, 1)->create();
        /** @var User $item */
        $item = $collection->get(0);

        $result = $service->findUser($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(UserService::class);

        $count = User::all()->count();

        factory(\App\Models\User::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchUsers();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreUserTableHasName() {

        $service = app()->make(UserService::class);

        factory(User::class, 3)->create();

        $users = $this->createUser();

        $service->storeUser($users);

        $this->assertDatabaseHas('users', [
            'name' => $users['name']
        ]);
    }

    public function testStoreUserCountIncrement() {
        $service = app()->make(UserService::class);
        $count = User::all()->count();

        $users = $this->createUser();
        $service->storeUser($users);

        $this->assertEquals($count + 1, User::all()->count());
    }

    public function testUpdateUser() {
        $service = app()->make(UserService::class);

        $collection = factory(\App\Models\User::class, 3)->create();
        /** @var User $item */
        $item = $collection->get(0);

        $service->updateUser($item, [
            'name' => $item->name,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $item->name
        ]);
    }

    public function testDeleteUser() {
        $service = app()->make(UserService::class);

        $collection = factory(\App\Models\User::class, 3)->create();
        $count = User::all()->count();

        $item = $collection->get(0);

        $service->destroyUsers([$item->id]);

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
