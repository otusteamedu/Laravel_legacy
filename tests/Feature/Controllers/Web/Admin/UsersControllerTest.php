<?php

namespace Tests\Feature\Controllers\Web\Admin;

use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    private function getUserRepository(): UserRepositoryInterface
    {
        return app()->make(UserRepositoryInterface::class);
    }

    public function testIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }

    public function testIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(403);
    }

    public function testIndexWithUsers()
    {
        $newUser = UserGenerator::createSimpleUser();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200)
            ->assertSeeText($newUser->name);
    }

    public function testCreateUserWontCreateUserWithTheSameEmail()
    {
        $data = UserGenerator::generateUserCreateData();
        $user = UserGenerator::createAdminUser();

        $data['email'] = 'test' . time() . '@yandex.ru';

        $this->actingAs($user)
            ->post(route('admin.users.store'), $data);

        $data['phone'] = $data['phone'] . time();

        $this->actingAs($user)
            ->post(route('admin.users.store'), $data);

        $this->assertEquals(1, User::where('email', $data['email'])->count());
    }

    public function testUnAuthenticatedUserWontCreateUserAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = UserGenerator::generateUserCreateData();
        $this->post(route('admin.users.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    public function testUpdateUser()
    {
        $user = UserGenerator::createAdminUser();
        $newUser = UserGenerator::createUser();

        $newUserArray = $newUser->toArray();
        $newUserArray['name'] = $this->faker->name() . time();

        $this->actingAs($user)->patch(
            route('admin.users.update', $newUser),
            $newUserArray
        )->assertStatus(302);

        $newUser->refresh();

        $this->assertEquals($newUser->name, $newUserArray['name']);
    }

    public function testDestroyUser()
    {
        $data = UserGenerator::generateUserCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.users.store'), $data);

        $this->assertGreaterThan(0, User::all()->count());

        $user = UserGenerator::createAdminUser();

        foreach (User::all() as $newUser) {
            $this->actingAs($user)
                ->delete(route('admin.users.destroy', ['user' => $newUser]))
                ->assertStatus(200);
        }

        $this->assertEquals(0, User::all()->count());
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.users.create'))
            ->assertStatus(200);
    }

    public function testCreatePageUnavailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.users.create'))
            ->assertStatus(403);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.users.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $newUser = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.users.edit', $newUser['id']))
            ->assertStatus(200);
    }

    public function testEditPageUnavailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();
        $newUser = UserGenerator::createSimpleUser();

        $status = $this->actingAs($user)
            ->get(route('admin.users.edit', $newUser))->status();

        $this->assertNotEquals($status, 200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $newUser = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.users.edit', $newUser))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $newUser = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.users.show', $newUser['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $newUser = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.users.show', $newUser))
            ->assertStatus(403);
    }
}
