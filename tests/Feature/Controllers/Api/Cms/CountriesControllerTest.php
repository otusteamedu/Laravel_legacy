<?php
/**
 * Description of CountriesControllerTest.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Tests\Feature\Controllers\Api\Cms;


use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

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
    public function testListWillReturn401IfUnauthicated()
    {
        CountryGenerator::createRussia();
        CountryGenerator::createUkraine();

        $this->json(
            'GET',
            route('api.countries.index')
        )
            ->assertStatus(401);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStore()
    {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;

        $this->json(
            'POST',
            route('api.countries.store'),
            [
                'name' => $name,
                'continent_name' => 'Europe',
            ]
        )->assertStatus(200);

        $this->assertDatabaseHas('countries', [
            'name' => $name,
        ]);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreWontCreateCountryWithoutName()
    {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;

        $this->json(
            'POST',
            route('api.countries.store'),
            [
                'continent_name' => 'Europe',
            ]
        )->assertStatus(422);

        $this->assertDatabaseMissing('countries', [
            'name' => $name,
        ]);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testStoreWontCreateCountryWithTheSameName()
    {
        $russia = CountryGenerator::createRussia();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $russia->name;

        $this->json(
            'POST',
            route('api.countries.store'),
            [
                'name' => $name,
                'continent_name' => 'Europe',
            ]
        )->assertStatus(422);

        $count = Country::where('name', $name)->count();
        $this->assertEquals(1, $count);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testShow()
    {
        $russia = CountryGenerator::createRussia();

        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('api.countries.show', [
                'country' => $russia->id
            ]),
        )->assertStatus(200);

        $response->json($russia->toArray());
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testShowWillReturn404IfModelNotFound()
    {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'GET',
            route('api.countries.show', [
                'country' => 'fdfd',
            ]))->assertStatus(404);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testUpdate()
    {
        $russia = CountryGenerator::createRussia();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $continent = $this->faker->state;

        $response = $this->json(
            'PUT',
            route('api.countries.update', [
                'country' => $russia->id,
            ]), [
            'continent_name' => $continent,
        ])
            ->assertStatus(200);

        $data = $russia->toArray();
        $data['continent_name'] = $continent;
        $response->assertJson([
            'name' => $russia->name,
            'continent_name' => $continent,
            'created_user_id' => $russia->created_user_id,
        ]);
    }

    /**
     * @group api
     * @group countries_api
     */
    public function testDeleteWontDelete()
    {
        $russia = CountryGenerator::createRussia();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'DELETE',
            '/api/delete/' . $russia->id
        )
            ->assertStatus(404);

        $this->assertDatabaseHas('countries', [
            'id' => $russia->id,
        ]);
    }

}