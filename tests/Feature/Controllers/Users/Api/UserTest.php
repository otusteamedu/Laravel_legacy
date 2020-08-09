<?php

namespace Tests\Feature\Controllers\Users\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class UserTest
 *
 * @group api
 * @group users
 * @group users.api
 * @group users.api.user
 * @package Tests\Feature\Controllers\Users\Api
 */
class UserTest extends TestCase
{

    public function testGetReturn401IfNoUser()
    {
        $this->json(
            'GET',
            route('api.user')
        )->assertStatus(401);
    }

    public function testGetCurrentUserData()
    {
        $user = UserGenerator::generateAdmin();

        Passport::actingAs($user);

        $this->json(
            'GET',
            route('api.user')
        )->assertStatus(200)
            ->assertJsonFragment(['email' => $user->email]);
    }

}
