<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Permission;
use Tests\Generators\UserGenerator;


class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testPermissionRoute()
    {
        $user = UserGenerator::createUserAdminWithRole(['name' => 'test_user3', 'email' => 'Admin']);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.permissions.index'));
        $response->assertStatus(200);
    }

}
