<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;

class WebTest extends TestCase
{
    /**
     * Test 'web' route.
     *
     * @return void
     */
    public function testWebRoute()
    {
        $response = $this->get(route('web'));
        $response->assertStatus(200);
        $response->assertSeeText('Feel free to sign up anytime!');
    }

    /**
     * Test 'web.dashboard' route.
     *
     * @return void
     */
    public function testWebPagesDashboardIndex()
    {
        $response = $this->get(route('web.dashboard'));
        $response->assertStatus(200);
        $response->assertSeeText('Latest workouts');
    }

    /**
     * Test 'web.content' route.
     *
     * @return void
     */
    public function testWebPagesContentIndex()
    {
        $response = $this->get(route('web.content'));
        $response->assertStatus(200);
        $response->assertSeeText('API Agreement');
    }

}
