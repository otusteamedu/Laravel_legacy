<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 'backend' route (not authorized).
     *
     * @return void
     */
    public function testBackendRouteNotAuthorized()
    {
        $response = $this->get(route('backend'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend' route (authorized).
     *
     * @return void
     */
    public function testBackendRouteAuthorized()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->get(route('backend'));
        $response->assertStatus(200);
        $response->assertSeeText('Backend');
    }

}
