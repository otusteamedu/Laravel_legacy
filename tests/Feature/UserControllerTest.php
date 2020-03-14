<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Class UserController
 * @package Tests\Feature
 * @group api
 *
 */
class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public $mockConsoleOutput = false;

    protected $passwordClient;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:client', ['--password' => null, '--no-interaction' => true]);

        $this->passwordClient = DB::table('oauth_clients')->where('password_client', 1)->first();
    }

    /**
     * getUser test
     */
    public function testGetUser()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('passport.token'), [
            'grant_type' => 'password',
            'client_id' => $this->passwordClient->id,
            'client_secret' => $this->passwordClient->secret,
            'username' => $user->email,
            'password' =>  'password',
            'scope' => '*'
        ]);

        $content = json_decode($response->baseResponse->content());

        $this->json('GET', route('user.index'), [],[
            'Authorization' => $content->token_type . ' ' . $content->access_token
        ])
            ->assertJsonFragment([
                'name' => $user->name,
                'email' => $user->email
            ]);
    }

    /**
     * User login test
     */
    public function testLogin()
    {
        $user = factory(User::class)->create();

        $this->post(route('passport.token'), [
            'grant_type' => 'password',
            'client_id' => $this->passwordClient->id,
            'client_secret' => $this->passwordClient->secret,
            'username' => $user->email,
            'password' =>  'password',
            'scope' => '*'
        ])
            ->assertOk()
            ->assertJsonCount(4)
        ;
    }

    /**
     * Register user test
     */
    public function testRegister()
    {
        $user = factory(User::class)->make();

        $this->json('post', route('user.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ])
            ->assertStatus(201)
            ->assertJsonCount(5)
        ;

        $newUser = User::where('email', $user->email);
        $this->assertNotNull($newUser);
    }

    /**
     * User logout test
     */
    public function testLogout()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('passport.token'), [
            'grant_type' => 'password',
            'client_id' => $this->passwordClient->id,
            'client_secret' => $this->passwordClient->secret,
            'username' => $user->email,
            'password' =>  'password',
            'scope' => '*'
        ]);

        $content = json_decode($response->baseResponse->content());

        $this->json('GET', route('user.logout'), [],[
            'Authorization' => $content->token_type . ' ' . $content->access_token
        ])
            ->assertOk();

        $users = DB::table('oauth_access_tokens')
            ->where('user_id', $user->id)
            ->where('revoked', 1)
            ->get();

        $this->assertEquals(1, count($users));
    }

    /**
     * User password update test
     */
    public function testPasswordUpdate()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('passport.token'), [
            'grant_type' => 'password',
            'client_id' => $this->passwordClient->id,
            'client_secret' => $this->passwordClient->secret,
            'username' => $user->email,
            'password' =>  'password',
            'scope' => '*'
        ]);

        $content = json_decode($response->baseResponse->content());

        $this->json('PUT', route('user.password.update'), [
            'old_password' => 'password',
            'new_password' => strrev('password')
        ],[
            'Authorization' => $content->token_type . ' ' . $content->access_token
        ])
            ->assertOk();

        $this->json('GET', route('user.logout'), [],[
            'Authorization' => $content->token_type . ' ' . $content->access_token
        ])
            ->assertOk();

        $this->post(route('passport.token'), [
            'grant_type' => 'password',
            'client_id' => $this->passwordClient->id,
            'client_secret' => $this->passwordClient->secret,
            'username' => $user->email,
            'password' =>  strrev('password'),
            'scope' => '*'
        ])
            ->assertOk();
    }
}