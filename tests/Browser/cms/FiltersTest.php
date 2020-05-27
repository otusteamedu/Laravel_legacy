<?php


namespace Tests\Browser\cms;


use App\Models\User;
use FilterTypesTableSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Generators\UserGenerator;

class FiltersTest extends \Tests\DuskTestCase
{
    use WithFaker;
//    use RefreshDatabase;
    use DatabaseMigrations ;

    /**
     * @throws \Throwable
     * @var Laravel\Dusk\Browser browser
     */
    public function testlogin()
    {
        $this->withoutExceptionHandling();
        $user = UserGenerator::createAdminUser();
        sleep(3);
        $user->fresh();
        $this->browse(function ($browser) use ($user){
//            dd($user, User::find(1));
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Login')
            ->assertPathIs('/home');
        });
    }



    public function testCreateFilter()
    {
        $user = UserGenerator::createAdminUser();
        $this->seed(FilterTypesTableSeeder::class);
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
