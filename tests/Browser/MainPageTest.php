<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class MainPageTest extends DuskTestCase
{
    /**
     * A basic browser test for main page.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function ($browser) {
            $browser->visit(route('index'))
                ->assertSee(config('app.name'));
        });
    }
}
