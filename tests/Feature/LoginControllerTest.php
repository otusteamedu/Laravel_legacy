<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class LoginControllerTest
 * @package Tests\Feature
 * @group LoginTest
 */
class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testLogin()
    {

        $user = $this->usersGenerator('admin');

        //непонятно почему редирект идет на /home
        //$response = $this->actingAs($user)->from(route('login'))->get(route('login'));
        //$response->assertRedirect('/admin');

        $response = $this->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'admin',
        ]);
        $response->assertRedirect('/admin');
        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);

    }

    public static function usersGenerator($state)
    {
        return factory(User::class)->state($state)->create();
    }

}
