<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\User;
use App\Models\SelectionMaterial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UsersControllersTest extends TestCase {
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */


    public function testCreateUserIfInvalidNameParam() {

        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.users.store'), [
                'email' => $this->faker->unique()->safeEmail,
                'password' => $this->faker->md5,
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateUserIfInvalidEmailParam() {

        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.users.store'), [
                'name' => $this->faker->name,
                'password' => $this->faker->md5,
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateUserIfInvalidPasswordParam() {

        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.users.store'), [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
            ])
            ->assertSessionHasErrors();
    }

    public function testFailStoreUser() {
        $user = UserGenerator::createSimpleUser();
        $dataUser = $this->createUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.users.store'), $dataUser)
            ->assertStatus(403);
    }

    public function testFailDeleteUser() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\User::class, 1)->create();
        /** @var User $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.users.destroy', ['user' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreUser() {
        $user = UserGenerator::createEditorUser();
        $dataUser = $this->createUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.users.store'), $dataUser)
            ->assertStatus(301);

        $this->assertDatabaseHas('users', [
            'email' => $dataUser['email']
        ]);
    }

    public function testCreatedOnlyOneUser() {
        $user = UserGenerator::createEditorUser();
        $dataUser = $this->createUser();

        $count = User::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.users.store'), $dataUser)
            ->assertStatus(301);

        $this->assertEquals($count + 1, User::all()->count());
    }

    public function testSuccessDeleteUser() {
        $user = UserGenerator::createAdminUser();
        $count = User::all()->count();

        $collection = factory(\App\Models\User::class, 1)->create();
        /** @var User $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.users.destroy', ['user' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, User::all()->count());
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
