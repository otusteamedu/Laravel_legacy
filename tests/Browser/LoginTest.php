<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generators\UserGenerator;

class LoginTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * A Dusk test example.
     *
     * @group login
     * @return void
     */
    public function testLoginSuccess()
    {
        $user = UserGenerator::createAdminUser([
            'email' => 'taylor@laravel.com',
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Login')
                ->waitForLocation('/home');
        });
    }

    /**
     * A Dusk test example.
     *
     * @group login
     * @return void
     */
    public function testLoginFail()
    {
        $user = UserGenerator::createAdminUser([
            'email' => 'taylor@laravel.com',
        ]);
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', '')
                ->press('Login')
                ->waitForLocation('/login');;
        });
    }
}
