<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\AccountGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginStatus()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testLoginUser()
    {
        $account = AccountGenerator::createAccount();

        $password = 'oh_i_pass';
        $userData = [
            'account_id' => $account->id,
            'password'=>bcrypt($password)
        ];

        $user = UserGenerator::createUser($userData);


        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
    }
}
