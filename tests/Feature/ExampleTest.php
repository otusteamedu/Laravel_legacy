<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ExampleTest
 *
 * @package Tests\Feature
 * @group myTest
 */
class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testBasicTest()
    {
        $user = User::make([
            'name' => 'fooo',
            'email' => '1@2.ru',
            'password' => '4441516',
            'status' => User::USER_STATUS_ACTIVE,
        ]);

        $this->assertFalse($user->isAdmin());
        $this->assertTrue($user->isActive());

        $user->wishlists()->get();


        /*        $response = $this->get('/');
                $response->assertStatus(200);

                $this->assertTrue(true);*/
    }

    public function testFoo()
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'sally@example.com',
        ]);
    }
}
