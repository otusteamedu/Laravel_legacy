<?php

namespace Tests\Controllers\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
//    use RefreshDatabase;
//    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group login
     */
    public function testExample()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
