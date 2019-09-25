<?php

namespace Tests\Browser\Cms;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generators\UserGenerator;

class CountriesTest
{

    use WithFaker, RefreshDatabase;

    /**
     * A Dusk test example.
     *
     * @group countries
     * @return void
     */
    public function testCreateCountry()
    {
        $user = UserGenerator::createAdminUser();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user->id)
                ->visit(route('cms.countries.create'))
                ->type('name', $this->faker->country)
                ->type('continent_name', $this->faker->randomElement(['Europe', 'Asia']))
                ->click('#create-country')
                ->assertPathIs(route('cms.countries.index'));
        });
    }
}
