<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        $this->seed();

        $user = factory(User::class)->create([
            'name' => 'admintest',
            'email' => 'admintest@mail.com',
            'password' => bcrypt($password = 'admin'),
            'status' => 'active',
            'level' => 1,
        ]);


        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);

    }
}
