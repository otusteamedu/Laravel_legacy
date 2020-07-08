<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AuthTest
 * @package Tests\Feature
 * @group auth
 */
class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\RoleSeeder::class);

        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);
    }

    /**
     * POST /login
     */
    public function testLogin(): void
    {
        /**
         * FAIL
         */
        $body = [
            'email' => $this->user->email,
            'password' => 'fail',
        ];
        $this->post(route('login'), $body)
            ->assertRedirect('/');

        /**
         * Success
         */
        $body = [
            'email' => $this->user->email,
            'password' => 'password',
        ];
        $this->post(route('login'), $body)
            ->assertRedirect(route('dashboard'));
    }

    /**
     * POST /logout
     */
    public function testLogout():void
    {
        $this->post(route('logout'))
            ->assertRedirect('/');
    }
}
