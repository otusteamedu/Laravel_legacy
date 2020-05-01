<?php

namespace Tests\Feature\Cms;

use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getCountryRepository(): CountryRepositoryInterface
    {
        return app()->make(CountryRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group countries
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.countries.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group countries
     * @group testIndexWithCountries
     */
    public function testIndexWithCountries()
    {
        $country = CountryGenerator::createRussia();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.countries.index'))
            ->assertStatus(200)
            ->assertSeeText($country->name);
    }

    /**
     * @group cms
     * @group countries
     * @group testUnAuthicatedUserWontCreateCountryAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateCountryAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateCountryCreateData();
        $this->post(route('cms.countries.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * @group cms
     * @group countries
     * @group testWontCreateCountryWithoutContinent
     */
    public function testWontCreateCountryWithoutContinent()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        unset($data['continent_name']);
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'continent_name'
            ]);

        $this->assertDatabaseMissing('countries', [
            'name' => $data['name'],
        ]);
    }


    /**
     * @group cms
     * @group countries
     * @group testCreateCountryFailsIfContinentNameIsEmpty
     */
    public function testCreateCountryFailsIfContinentNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $data = [
            'name' => $this->faker->country,
        ];
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('countries', [
            'name' => $data['name'],
        ]);

        $this->assertEquals(0, Country::all()->count());
    }

    /**
     * @group cms
     * @group countries
     * @group testCreateCountryFailsIfNameIsEmpty
     */
    public function testCreateCountryFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.countries.store'), [
                'continent_name' => 'Europe',
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Country::all()->count());
    }

    /**
     * @group cms
     * @group countries
     * @group testCreateCountryFailsIfParamsAreEmpty
     */
    public function testCreateCountryFailsIfParamsAreEmpty()
    {
        $this->createCountry([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Country::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group countries
     * @group testCreateCountryWontCreateCountryWithTheSameName
     */
    public function testCreateCountryWontCreateCountryWithTheSameName()
    {
        $data = $this->generateCountryCreateData();

        $this->createCountry($data);
        $this->createCountry($data);
        $this->createCountry($data);

        $this->assertEquals(1, Country::all()->count());
    }

    /**
     * @group cms
     * @group countries
     * @group testUpdateCountry
     */
    public function testUpdateCountry()
    {
        $user = UserGenerator::createAdminUser();
        $country = CountryGenerator::createCountry();

        $name = $this->faker->country . microtime(true);
        $this->actingAs($user)
            ->patch(route('cms.countries.update', [
                'country' => $country->id,
            ]), [
                'name' => $name,
                'continent_name' => $country->continent_name,
            ])
            ->assertStatus(302);

        $country->refresh();
        $this->assertEquals($country->name, $name);
    }

    /**
     * @group cms
     * @group countries
     * @group testUpdateCountryWontUpdateWithoutContinent
     */
    public function testUpdateCountryWontUpdateWithoutContinent()
    {
        $user = UserGenerator::createAdminUser();
        $country = CountryGenerator::createCountry();

        $name = $this->faker->country . microtime(true);
        $this->actingAs($user)
            ->patch(route('cms.countries.update', [
                'country' => $country->id,
            ]), [
                'name' => $name,
            ])
            ->assertSessionHasErrors([
                'continent_name',
            ])
            ->assertStatus(302);

        $country->refresh();
        $this->assertNotEquals($country->name, $name);
    }

    /**
     * @group cms
     * @group countries
     * @group testUpdateCountryWontUpdateWithTheSameName
     */
    public function testUpdateCountryWontUpdateWithTheSameName()
    {
        $user = UserGenerator::createAdminUser();
        $countryRussia = CountryGenerator::createRussia();
        $country = CountryGenerator::createCountry();

        $name = $countryRussia->name;
        $this->actingAs($user)
            ->patch(route('cms.countries.update', [
                'country' => $country->id,
            ]), [
                'name' => $name,
                'continent_name' => $country->continent_name,
            ])
            ->assertSessionHasErrors([
                'name',
            ])
            ->assertStatus(302);

        $country->refresh();
        $this->assertNotEquals($country->name, $name);
    }

    /**
     * @return array
     */
    private function generateCountryCreateData(): array
    {
        return [
            'name' => $this->faker->country,
            'continent_name' => $this->faker->randomElement([
                'Europe',
                'Asia',
            ])
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createCountry(array $data)
    {
        $user = UserGenerator::createAdminUser();

        return $this->actingAs($user)
            ->post(route('cms.countries.store'), $data);
    }

}
