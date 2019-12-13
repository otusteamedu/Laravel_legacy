<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testNoAccessHomeForGuest()
    {
        $this->get(route('home'))
            ->assertRedirect('/login');
    }

    public function testSeeHomeForAuth()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertStatus(200);
    }
}
