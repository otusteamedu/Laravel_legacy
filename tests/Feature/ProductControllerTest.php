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
//    public function testProductIndexExists()
//    {
//
//        $user = factory(User::class)->create([
//            'name'=>'admintest',
//            'email'=>'admintest@mail.com',
//            'password'=>bcrypt($password = 'admin'),
//            'status'=>'active',
//            'level'=>1,
//        ]);
//
//
//        $response = $this->from('/login')->post('/login',[
//            'email' => $user->email,
//            'password' => $password,
//        ]);
//        $response->assertStatus(302);
//        $response->assertRedirect('/admin');
//        $this->assertAuthenticatedAs($user);
//
//    }

    public function testProductIndex()
    {
        Auth::loginUsingId(1);

        $response = $this->get(route('admin.product.index'));
        $response->assertStatus(200);
    }

    public function testProductCreate()
    {
        Auth::loginUsingId(1);

        $response = $this->get(route('admin.product.create'));
        $response->assertStatus(200);
    }

    public function testProductStore()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.product.create'))->post(route('admin.product.store'), [
            'name' => 'text',
            'description' => 'text',
            'price' => 1234,
            'category_id' => rand(1, 3),
        ]);
        $response->assertRedirect(route('admin.product.index'));
//        $response->assertStatus(200);
    }

    public function testProductEdit()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.product.index'))->get(route('admin.product.edit',['product'=>1]), [
            'product' => 1
        ]);
//        $response->assertRedirect(route('admin.product.index'));
        $response->assertStatus(200);
    }

}


