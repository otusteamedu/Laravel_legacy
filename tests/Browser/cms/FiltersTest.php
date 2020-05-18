<?php


namespace Tests\Browser\cms;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Generators\UserGenerator;

class FiltersTest extends \Tests\DuskTestCase
{
    use WithFaker;
//    use RefreshDatabase;

    public function testCreateFilter()
    {
        $user = UserGenerator::createAdminUser();
//dd($user);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('cms.filters.create'))
                ->type('name', $this->faker->name)
                ->type('description', 'TEST_value')
                ->type('@value', '12-99')
                ->select('filter_type_id', '1')
                ->click('input.btn.btn-primary')
                ->assertUrlIs(route('cms.filters.index'));
//                ->waitForRoute(route('cms.filters.index'))
//                ->waitForLocation(route('cms.filters.index'))
//                ->assertPathIs(route('cms.filters.index'));
//                ->assertPathIs(route('cms.filters.index'));
//                ->assertSee('Laravel');
        });


    }

}
