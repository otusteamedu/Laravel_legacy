<?php
/**
 * Description of CountriesControllerTest.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Tests\Feature\Controllers\Api\Cms\Countries;


use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ListCountriesControllerTest extends TestCase
{

    use WithFaker;

    /**
     * @group api
     * @group countries_api
     */
    public function testList()
    {
        $ru = CountryGenerator::createRussia();
        $ua = CountryGenerator::createUkraine();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('api.countries.index')
        )
            ->assertStatus(200);
        $response->assertJsonCount(2);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testListReturn401IfNoUser()
    {
        CountryGenerator::createCountry();
        CountryGenerator::createCountry();

        $this->json(
            'GET',
            route('api.countries.index')
        )
            ->assertStatus(401);;
    }

}
