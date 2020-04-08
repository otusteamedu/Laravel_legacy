<?php
/**
 * Тесты для контроллера стран
 */

namespace Tests\Feature\Controllers;


use App\Models\Country;
use App\Models\Currency;
use App\Models\Organization;
use App\Models\User;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\CountryGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{
    //use DatabaseTransactions;
    use RefreshDatabase;
    use WithFaker;

    private function getCountryRepository(): CountryRepositoryInterface
    {
        return app()->make(CountryRepositoryInterface::class);
    }


    /**
     * @group cms
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.countries.index'))
            ->assertStatus(200)
            ->assertSeeText('Страны')
        ;
    }

    /**
     * @group cms
     */
    public function testIndexWithCountries()
    {
        $country = CountryGenerator::createRussia();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.countries.index'))
            ->assertStatus(200)
            ->assertSeeText($country->name);
        $this->assertDatabaseHas('countries', [
                'name' => $country->name,
            ]);
    }

    /**
     * @group cms
     */
    public function testSearchCountries()
    {
        $country1 = CountryGenerator::createRussia();
        $country2 = CountryGenerator::createSerbia();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->post(route('cms.countries.index'), ['name' => $country1->name])
            ->assertStatus(200)
            ->assertSeeText($country1->name)
            ->assertDontSeeText($country2->name)
            ;
    }

    /**
     * @group cms
     */
    public function testSearchCountriesNotFound()
    {
        $country1 = CountryGenerator::createRussia();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->post(route('cms.countries.index'), ['name' => 'Serbia'])
            ->assertStatus(200)
            ->assertDontSeeText($country1->name)
        ;
    }

    /**
     * @group cms
     */
    public function testUnAuthicatedUserWontCreateCountryAndRedirectOnLogin()
    {
        $data = $this->generateCountryCreateData();
        $this->post(route('cms.countries.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @group cms
     */
    public function testCreateCountry()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
        ]);
    }

    /**
     * @group cms
     */
    public function testCreateCountryDuplicate()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
        ]);

        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name',
                'name_eng'
            ]);
        ;
    }

    /**
     * @group cms
     */
    public function testWontCreateCountryWithoutName()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $name = $data['name'];
        $nameEng= $data['name_eng'];
        unset($data['name'], $data['name_eng']);
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name',
                'name_eng'
            ]);

        $this->assertDatabaseMissing('countries', [
            'name' => $name,
            'name_eng' => $nameEng,
        ]);
    }

    /**
     * @group cms
     */
    public function testCreateCountryWithCurrency()
    {
        $user = UserGenerator::createAdminUser();
        $currency = new Currency();
        $currencyCode = $this->faker->currencyCode;
        $currency->create([
            'id' => 1,
            'code' => $currencyCode,
        ]);
        $this->assertDatabaseHas('currencies', [
            'id' => 1,
            'code' => $currencyCode,
        ]);

        $data = $this->generateCountryCreateData();
        $data['currency_id'] = 1;
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
            'currency_id' => 1,
        ]);
    }

    /**
     * @group cms
     */
    public function testCreateCountryWithNotExistCurrency()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $data['currency_id'] = 111111;
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
        ;
        $this->assertDatabaseMissing('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
            'currency_id' => 111,
        ]);
    }

    /**
     * @group cms
     */
    public function testUpdateCountry()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
        ]);
        $country = Country::where('name', $data['name'])->get();
        $newData = $this->generateCountryCreateData();
        $newData['id'] = $country[0]->id;

        $this->actingAs($user)
            ->post(route('cms.countries.update'), $newData)
            ->assertStatus(200);
        $this->assertDatabaseHas('countries', [
            'name' => $newData['name'],
            'name_eng' => $newData['name_eng'],
        ]);
    }

    /**
     * @group cms
     */
    public function testUpdateCountryWithNotExistCurrency()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
        ]);
        $country = Country::where('name', $data['name'])->get();
        $newData = $this->generateCountryCreateData();
        $newData['id'] = $country[0]->id;
        $newData['currency_id'] = 111111;

        $this->actingAs($user)
            ->post(route('cms.countries.update'), $newData);

        $this->assertDatabaseMissing('countries', [
            'name' => $newData['name'],
            'name_eng' => $newData['name_eng'],
            'currency_id' => $newData['currency_id'],
        ]);
    }

    /**
     * @group cms
     */
    public function testDeleteCountry()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCountryCreateData();
        $this->actingAs($user)
            ->post(route('cms.countries.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
        ]);
        $country = Country::where('name', $data['name'])->get();
        $countryId = $country[0]->id;

        $this->actingAs($user)
            ->post(route('cms.countries.delete'), ['id' => $countryId])
            ->assertStatus(200);
        $this->assertDatabaseMissing('countries', [
            'name' => $data['name'],
            'name_eng' => $data['name_eng'],
        ]);
    }

    /**
     * @return array
     */
    private function generateCountryCreateData(): array
    {
        return [
            'name' => $this->faker->country,
            'name_eng' => $this->faker->country,
            'currency_id' => null,
        ];
    }

}
