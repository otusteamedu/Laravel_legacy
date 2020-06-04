<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testRegisterStatus()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testRegisterUser()
    {

        $email = $this->faker->email;

        $response = $this->post('/register', [
            'email' => $email,
            'password' => 'oh_i_pass',
            'password_confirmation' => 'oh_i_pass',
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);

        $response->assertStatus(302);

    }

}
