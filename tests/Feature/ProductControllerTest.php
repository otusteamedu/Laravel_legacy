<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductIndexExists()
    {

        $user = factory(User::class)->create([
            'name'=>'admintest',
            'email'=>'admintest@mail.com',
            'password'=>bcrypt($password = 'admin'),
            'status'=>'active',
            'level'=>1,
        ]);


        $response = $this->from('/login')->post('/login',[
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);

    }

    public function testProductCreate()
    {
        Auth::loginUsingId(1);
        $response = $this->get('/admin/create/');
        $response->assertStatus(200);
    }

}


