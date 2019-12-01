<?php
/**
 * Description of CountriesControllerTest.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Tests\Feature\Controllers\Cms;


use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A Dusk test example.
     *
     * @group countries
     * @return void
     */
    public function testCreateCountry()
    {
        $data = $this->generateCountryCreateData();
        $this->createCountry($data)
            ->assertStatus(201);

        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
        ]);
    }

    /**
     * A Dusk test example.
     *
     * @group countries
     * @return void
     */
    public function testCreateCountryStoresOnlyOneCountry()
    {
        $data = $this->generateCountryCreateData();
        $this->createCountry($data)
            ->assertStatus(201);

        $this->assertEquals(1, Country::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group countries
     * @return void
     */
    public function testCreateCountryFailsIfContinentNameIsEmpty()
    {
        $data = [
            'name' => $this->faker->country,
        ];
        $this->createCountry($data)
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('countries', [
            'name' => $data['name'],
        ]);

        $this->assertEquals(0, Country::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group countries
     * @return void
     */
    public function testCreateCountryFailsIfNameIsEmpty()
    {
        $this->createCountry([
            'continent_name' => 'Europe',
        ])->assertSessionHasErrors();

        $this->assertEquals(0, Country::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group countries
     * @return void
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
     * @group countries
     * @return void
     */
    public function testCreateCountryWontCreateCountryWithTheSameName()
    {
        $data = $this->generateCountryCreateData();

        $this->createCountry($data);
        $this->createCountry($data);

        $this->assertEquals(1, Country::all()->count());
    }
//
//    /**
//     * A Dusk test example.
//     *
//     * @group countries
//     * @return void
//     */
//    public function testCreateCountryWontCreateCountryIfNoUser()
//    {
//        $data = $this->generateCountryCreateData();
//        $this->post(route('cms.countries.store'), $data);
//
//        $this->assertEquals(0, CountryResource::all()->count());
//    }
//
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
            ->post(route('cms.countries.store', [
                'locale' => config('app.locale'),
            ]), $data);

    }

}