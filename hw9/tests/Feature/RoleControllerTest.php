<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Role;
use Tests\Generators\UserGenerator;


class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRoleRoute()
    {
        $user = UserGenerator::createUserAdminWithRole(['name' => 'test_user3', 'email' => 'admin@mail.ru']);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.roles.index'));
        $response->assertStatus(200);
    }

}



