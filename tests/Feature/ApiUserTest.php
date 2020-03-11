<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ApiUserTest
 * @package Tests\Feature
 * @group Api
 */
class ApiUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHasUser()
    {
        $id = 2;
        $this->json('GET', route('user_api', [
            'id' => $id,
            'Accept' => 'application/json'
        ]))
            ->assertOk();
    }
}
