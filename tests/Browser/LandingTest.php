<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LandingTest extends DuskTestCase
{
    public function testAnalyzeButtonDisabledOnSubmit()
    {
        $this->browse(static function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(config('app.name'))
                ->type('url', 'dummy');

            // prevent browser to navigate to next page on form submit
            $browser->script("$('[dusk=analyze-button]').closest('form').on('submit', (e) => e.preventDefault())");

            $browser->click('@analyze-button');
            $browser->waitFor('button[dusk="analyze-button"][disabled]');
        });
    }
}
