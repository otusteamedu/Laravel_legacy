<?php
/**
 * Description of StoreCountriesControllerTest.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Tests\Feature\Controllers\Api\Cms\Countries;


use Laravel\Passport\Passport;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UpdateCountriesControllerTest extends TestCase
{

    /**
     * @group api
     * @group countries_api
     */
    public function testUpdateReturn401IfNoUser()
    {
        $country = CountryGenerator::createRussia();

        $data = [
            'name' => 'Ukraine',
        ];

        $this->json(
            'PATCH',
            route('api.countries.update', [
                'country' => $country->id,
            ]),
            $data
        )->assertStatus(401);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testUpdate()
    {
        $country = CountryGenerator::createRussia();
        $data = [
            'name' => 'Ukraine',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'PATCH',
            route('api.countries.update', [
                'country' => $country->id,
            ]),
            $data
        )->assertStatus(200);

        $updatedCountry = $country->fresh();
        $this->assertEquals($data['name'], $updatedCountry->name);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testUpdateWontUpdateWithExistingCountryName()
    {
        $ua = CountryGenerator::createUkraine();
        $ru = CountryGenerator::createRussia();

        $data = [
            'name' => $ua->name,
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'PATCH',
            route('api.countries.update', [
                'country' => $ru->id,
            ]),
            $data
        )->assertStatus(422);

        $updatedCountry = $ru->fresh();
        $this->assertEquals($ru->name, $updatedCountry->name);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testUpdateCountryContinentNameWithCurrentName()
    {
        $ru = CountryGenerator::createRussia();

        $data = [
            'name' => $ru->name,
            'continent_name' => 'America',
        ];

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'PATCH',
            route('api.countries.update', [
                'country' => $ru->id,
            ]),
            $data
        )->assertStatus(200);

        $updatedCountry = $ru->fresh();
        $this->assertEquals($ru->name, $updatedCountry->name);
        $this->assertEquals($data['continent_name'], $updatedCountry->continent_name);
    }
}
