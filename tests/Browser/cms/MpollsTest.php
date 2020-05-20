<?php

namespace Tests\Browser\cms;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Generators\UserGenerator;

class MpollsTest extends DuskTestCase
{
    use WithFaker;
    use DatabaseMigrations;

    public function testCreateMpoll()
    {
        $user = UserGenerator::createAdminUser();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('cms.mpolls.create'))
                ->type('name', $this->faker->name)
                ->type('description', 'TEST_value')
                ->type('country_id', '23')
                ->click('input.btn.btn-primary')
                ->assertUrlIs(route('cms.mpolls.index'));
        });
    }
}
