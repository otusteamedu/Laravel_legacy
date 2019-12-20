<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LandingTest extends DuskTestCase
{
    public function testBasicExample()
    {
        $this->browse(static function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(config('app.name'))
                ->type('repository', 'dummy')
                ->click('@analyze-button');

            //$browser->assertButtonDisabled('@analyze-button');

            $browser->waitForRoute('landing.try');
        });
    }
}
