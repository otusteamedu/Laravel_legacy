<?php

namespace Tests\Feature\Controllers\Web\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RolesControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.roles.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.roles.index'))
            ->assertStatus(200);
    }

    public function testIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.roles.index'))
            ->assertStatus(403);
    }

    public function testUnAuthenticatedUserWontCreateRoleAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = RoleGenerator::generateRoleCreateData();
        $this->post(route('admin.roles.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.roles.create'))
            ->assertStatus(200);
    }

    public function testCreatePageAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.roles.create'))
            ->assertStatus(403);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.roles.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $role = RoleGenerator::createRole();

        $this->actingAs($user)
            ->get(route('admin.roles.edit', $role['id']))
            ->assertStatus(200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $role = RoleGenerator::createRole();

        $this->actingAs($user)
            ->get(route('admin.roles.edit', $role))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $role = RoleGenerator::createRole();

        $this->actingAs($user)
            ->get(route('admin.roles.show', $role['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $role = RoleGenerator::createRole();

        $this->actingAs($user)
            ->get(route('admin.roles.show', $role))
            ->assertStatus(403);
    }
}
