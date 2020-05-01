<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\City;
use App\Services\Cities\Repositories\CityRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\CityGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CitiesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getCityRepository(): CityRepositoryInterface
    {
        return app()->make(CityRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group cities
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.cities.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group cities
     * @group testIndexWithCities
     */
    public function testIndexWithCities()
    {
        $city = CityGenerator::createMoscow();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.cities.index'))
            ->assertStatus(200)
            ->assertSeeText($city->name);
    }

    /**
     * @group cms
     * @group cities
     * @group testUnAuthicatedUserWontCreateCityAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateCityAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateCityCreateData();
        $this->post(route('cms.cities.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group cities
     * @group testCreateCity
     * @return void
     */
    public function testCreateCity()
    {
        $data = $this->generateCityCreateData();
        $this->createCity($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('cities', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(City::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group cities
     * @group testCreateCityFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateCityFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.cities.store'), [
                'country_id' => function(){
                    return factory(App\Models\Country::class)->create()->id;
                },
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, City::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group cities
     * @group testCreateCityFailsIfNameIsEmpty
     * @return void
     */

    public function testCreateCityFailsIfCountryIdIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.cities.store'), [
                'name' => $this->faker->city,
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, City::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group cities
     * @group testCreateCityFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateCityFailsIfParamsAreEmpty()
    {
        $this->createCity([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, City::all()->count());
    }

    /**
     * @return array
     */
    private function generateCityCreateData(): array
    {
        return [
            'name' => $this->faker->city,
            'country_id' => function(){
                return factory(App\Models\Country::class)->create()->id;
            }
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createCity(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.cities.store'), $data);
    }

}
