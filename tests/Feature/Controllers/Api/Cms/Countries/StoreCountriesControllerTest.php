<?php
/**
 * Description of StoreCountriesControllerTest.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Tests\Feature\Controllers\Api\Cms\Countries;


use App\Services\Notifications\SMS\SmsSender;
use App\Services\Notifications\SMS\StubSmsSender;
use Mockery\Mock;
use Str;
use App\Models\Country;
use Laravel\Passport\Passport;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class StoreCountriesControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(SmsSender::class, StubSmsSender::class);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreReturn401IfNoUser()
    {
        $data = CountryGenerator::createRussiaData();

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(401);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStore()
    {
        $data = CountryGenerator::createRussiaData();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(200);

        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
        ]);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreReturnsCountry()
    {
        $data = CountryGenerator::createRussiaData();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(200)
            ->assertJsonFragment($data);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreCreatesOnlyOneCountry()
    {
        $data = CountryGenerator::createRussiaData();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(200);

        $this->assertEquals(1, Country::count());
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreReturn422IfNameIsTooLong()
    {
        $data = CountryGenerator::createLongNameData();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(422);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreWithName100Chars()
    {
        $data = CountryGenerator::createLongNameData(100);

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(200);

        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
        ]);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreReturn422IfNoContinent()
    {
        $data = [
            'name' => 'Russia',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(422);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreReturn422IfNoName()
    {
        $data = [
            'continent_name' => 'Europe',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(422);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreReturn422IfNoCountryAlreadyExists()
    {
        $ru = CountryGenerator::createRussia();
        $data = [
            'name' => $ru->name,
            'continent_name' => $ru->continent_name,
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'POST',
            route('api.countries.store'),
            $data
        )->assertStatus(422);

        $this->assertEquals(1, Country::count());
    }
}
