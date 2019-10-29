<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Permission;
use Tests\Generators\UserGenerator;


class PermissionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatePermission()
    {
        $data['id'] = Permission::PERMISSION_ALL;
        $data['name'] = 'test_permission';
        $data['route'] = 'test_permission';
        $permission = factory(Permission::class)->create($data);
        $this->assertDatabaseHas('permissions', [
            'name' => $data['name'],
        ]);
    }

    /**
     * Check don't create permission with the same email
     * @expectException PDOException
     */
    public function testCreatePermissionFailsDublicate()
    {
        $data['id'] = Permission::PERMISSION_ALL;
        $data['name'] = 'test_permission2';
        $data['route'] = 'test_permission';
        $permissions_count_before = Permission::all()->count();
        $permission = factory(Permission::class)->create($data);
        $this->assertEquals($permissions_count_before + 1, Permission::all()->count());
        $this->expectExceptionCode(23000);
        $this->expectExceptionMessageRegExp('/Duplicate entry/');

        $permission = factory(Permission::class)->create($data);
    }

    /**
     * Check don't create permission with the empty data
     * @expectException QueryException
     */

    public function testCreatePermissionFailsEmpty()
    {
        $data['id'] = Permission::PERMISSION_ALL;
        $data['name'] = null;
        $this->expectExceptionMessageRegExp('/ cannot be null/');
        $this->expectException(QueryException::class);
        $this->expectExceptionCode(23000);

        $permission = factory(Permission::class)->create($data);
    }

    public function testDeletePermission()
    {
        $data['name'] = 'test_permission2';
        $res = Permission::where('name', $data['name'])->delete();
        $this->assertDatabaseMissing('permissions', [
            'name' => $data['name'],
        ]);
    }
}
