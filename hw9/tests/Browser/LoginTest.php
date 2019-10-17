<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $this->visit('/login')
                ->type('admin@mail.ru', 'email')
                ->type('secret', 'password')
                ->check('remember')
                ->press('Login')
                ->seePageIs('/home')
                ->see('You are logged in!');

        });
    }

    public function testRoles()
    {
        $this->browse(function (Browser $browser) {
            $this->visit('/admin/roles')
                ->see('Роли');

        });
    }
}
