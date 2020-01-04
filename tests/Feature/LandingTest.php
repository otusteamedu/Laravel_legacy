<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLanding()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee(trans('landing.slogan'))
            ->assertSee(trans('landing.run_url'))
            ->assertSee(trans('landing.submit'));
    }
}
