<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @group login
     * @return void
     */
    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
