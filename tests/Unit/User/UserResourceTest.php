<?php

namespace Tests\Unit\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\User\Resources\User as UserResource;

/**
 * Class UserResourceTest
 * @package Tests\Unit\User
 *
 * @group userResource
 */
class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('LaratrustSeeder');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $testingRoleName = 'user';

        /** @var User $user */
        $user = factory(User::class)->create();
        $user->attachRole($testingRoleName);

        $userResource = new UserResource($user);

        $userResponseJson = response()->json($userResource)->getData();

        $userRole = $userResponseJson->roles;

        $role = Role::findOrFail($userRole);

        $this->assertEquals($testingRoleName, $role->name);
        $this->assertEquals($user->id, $userResponseJson->id);
        $this->assertEquals($user->name, $userResponseJson->name);
        $this->assertEquals($user->email, $userResponseJson->email);
        $this->assertEquals($user->publish, $userResponseJson->publish);
    }
}
