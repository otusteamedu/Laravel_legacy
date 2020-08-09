<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class AuthTest
 *
 * @group users
 * @group users.auth
 * @package Tests\Feature\Users
 */
class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @param string $url
     *
     * @testWith ["login"]
     *           ["password/reset"]
     *
     * @return void
     */
    public function testCheckAvailable(string $url)
    {
        $response = $this->get('/' . $url);

        $response->assertStatus(200);
    }
}
