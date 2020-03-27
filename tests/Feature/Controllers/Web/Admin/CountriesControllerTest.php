<?php

namespace Tests\Feature\Controllers\Web\Admin;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndexAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.countries.index'))
            ->assertStatus(200);
    }

    public function testIndexAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.countries.index'))
            ->assertStatus(200);
    }

    public function testIndexUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.countries.index'))
            ->assertStatus(403);
    }

    public function testCreateCountryStoresOnlyCountry()
    {
        $data = CountryGenerator::generateCountryCreateData();
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('admin.countries.store'), $data);

        $this->assertEquals(1, Country::all()->count());
    }

    public function testCreatePageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.countries.create'))
            ->assertStatus(200);
    }

    public function testCreatePageAvailableForModerators()
    {
        $user = UserGenerator::createModeratorUser();

        $this->actingAs($user)
            ->get(route('admin.countries.create'))
            ->assertStatus(200);
    }

    public function testCreatePageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();

        $this->actingAs($user)
            ->get(route('admin.countries.create'))
            ->assertStatus(403);
    }

    public function testEditPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $country = CountryGenerator::createCountry();

        $this->actingAs($user)
            ->get(route('admin.countries.edit', $country['id']))
            ->assertStatus(200);
    }

    public function testEditPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $country = CountryGenerator::createCountry();

        $this->actingAs($user)
            ->get(route('admin.countries.edit', $country))
            ->assertStatus(403);
    }

    public function testShowPageAvailableForAdministrators()
    {
        $user = UserGenerator::createAdminUser();
        $country = CountryGenerator::createCountry();

        $this->actingAs($user)
            ->get(route('admin.countries.show', $country['id']))
            ->assertStatus(200);
    }

    public function testShowPageUnavailableForSimpleUser()
    {
        $user = UserGenerator::createUser();
        $country = CountryGenerator::createCountry();

        $this->actingAs($user)
            ->get(route('admin.countries.show', $country))
            ->assertStatus(403);
    }
}
