<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\Permission;
use Tests\Generators\UserGenerator;
use Illuminate\Support\Facades\Auth;


class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRoute()
    {
        $user = UserGenerator::createUserAdminWithRole(['name' => 'test_user3', 'email' => 'admin@mail.ru']);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.users.index'));
        $response->assertStatus(200);

    }

    public function testUserNotPerminssion()
    {
        $user = new User([
            'id' => rand(1, 10),
            'name' => 'yish'
        ]);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.users.index'));
        $response->assertStatus(403);
    }


}
