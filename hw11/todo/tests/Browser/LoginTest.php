<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generators\UserGenerator;

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
            $browser->visit('/login')
                ->type('admin@mail.ru', 'email')
                ->type('secret', 'password')
                ->check('remember')
                ->press('Login')
                ->seePageIs('/home')
                ->see('You are logged in!');

        });
    }
    public function testAuthentication()
    {
        $data['name'] = 'test_user3';
        $data['email'] = 'test_user3@test.ru';
        $user = UserGenerator::createUserAdmin($data);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/admin')
                ->assertSee('Панель администратора')
                ->assertAuthenticatedAs($user)
                ->logout()
                ->assertGuest();
        });
    }

    public function testRoles()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/roles')
                ->assertSee('Роли');

        });
    }
}
