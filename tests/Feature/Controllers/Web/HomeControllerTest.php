<?php

namespace Tests\Feature\Controllers\Web\Admin;

use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIndexAvailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('index'))
            ->assertStatus(200);
    }

    public function testPersonalAvailableForAuthUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('personal.index'))
            ->assertStatus(200);
    }

    public function testPersonalUnavailableForNonAuthUser()
    {
        $this->get(route('personal.index'))->assertRedirect();
    }

    public function testAboutAvailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('about.index'))
            ->assertStatus(200);
    }

    public function testAdminIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.index'))
            ->assertStatus(200);
    }

    public function testAdminIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.index'))
            ->assertStatus(200);
    }

    public function testAdminIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.index'))
            ->assertStatus(403);
    }
}
