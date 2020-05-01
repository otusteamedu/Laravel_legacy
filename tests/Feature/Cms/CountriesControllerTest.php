<?php

namespace Tests\Feature\Cms;

use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\Generators\CountryGenerator;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    private function getCountryRepository(): CountryRepositoryInterface
    {
        return app()->make(CountryRepositoryInterface::class);
    }

    public function testIndex()
    {
        $user = (new \Tests\Generators\UserGenerator)->createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.countries.index'))
            ->assertStatus(200);
    }

    public function testIndexWithCountries()
    {
        $country = CountryGenerator::createRussia();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.countries.index'))
            ->assertStatus(200)
            ->assertSeeText($country->name);
    }

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
