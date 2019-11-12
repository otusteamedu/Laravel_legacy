<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Role;
use App\Models\User;


class RoleTest extends TestCase
{
   // use RefreshDatabase;

    public function testRoleRoute()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.roles.index'));
        $response->assertStatus(200);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateRole()
    {

        $data['name'] = 'test_role';
        $role = factory(Role::class)->create($data);
        $this->assertDatabaseHas('roles', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Check don't create role with the same email
     * @expectException PDOException
     */
    public function testCreateRoleFailsDublicate()
    {
        $data['name'] = 'test_role2';
        $roles_count_before = Role::all()->count();
        $role = factory(Role::class)->create($data);
        $this->assertEquals($roles_count_before + 1, Role::all()->count());

        $roles_count_before = Role::all()->count();

        $this->expectExceptionCode(23000);
        $this->expectExceptionMessageRegExp('/Duplicate entry/');
        $role = factory(Role::class)->create($data);
    }

    /**
     * Check don't create role with the empty data
     * @expectException QueryException
     */

    public function testCreateRoleFailsEmpty()
    {
        $data['name'] = null;
        $roles_count_before = Role::all()->count();
        $this->expectExceptionMessageRegExp('/ cannot be null/');
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);

        $role = factory(Role::class)->create($data);
    }

    public function testDeleteRole()
    {

        $data['name'] = 'test_role2';
        $res = Role::where('name', $data['name'])->delete();
        $this->assertDatabaseMissing('roles', [
            'name' => $data['name'],
        ]);
    }
}



