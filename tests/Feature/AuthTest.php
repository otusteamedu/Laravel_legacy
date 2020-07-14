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
    }

    /**
     * POST /login
     */
    public function testLoginSuccess(): void
    {
        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);

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
     * POST /login
     */
    public function testLoginWrongPassword(): void
    {
        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);

        /**
         * FAIL
         */
        $body = [
            'email' => $this->user->email,
            'password' => 'fail',
        ];
        $this->post(route('login'), $body)
            ->assertRedirect('/');
    }

    /**
     * POST /login
     */
    public function testLoginNotExistEmail(): void
    {
        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);

        /**
         * FAIL
         */
        $body = [
            'email' => 'test',
            'password' => 'password',
        ];
        $this->post(route('login'), $body)
            ->assertRedirect('/');
    }

    /**
     * POST /logout
     */
    public function testLogout():void
    {
        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);

        $this->post(route('logout'))
            ->assertRedirect('/');
    }
}
