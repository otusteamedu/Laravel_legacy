<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AuthActionsTest
 *
 * @package Tests\Feature
 */
class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    public $users;

    public function setUp() :void
    {
        parent::setUp();

        $this->users = factory(User::class, 3)
            ->states(['active', 'customer'])
            ->create();
    }

    public function testCantChangeStatusOrGroupWhenRegistering()
    {
        $user = factory(User::class)->states(
            [
                'static-password',
                'admin',
                'banned',
            ]
        )->make();

        $response = $this->from(route('register'))
            ->post(route('register'), $user->only(
                [
                    'name',
                    'email',
                    'password',
                    'password_confirmation',
                    'group',
                    'status',
                ]
            ));

        $response->assertSessionHasNoErrors();

        $user = \DB::table('users')
            ->select('id')
            ->orderByDesc('id')
            ->first();

        \Auth::loginUsingId($user->id);
        $this->assertFalse(\Auth::user()->isAdmin());
        $this->assertTrue(\Auth::user()->isActive());
    }

    public function testUnauthUserCantViewProfiles()
    {
        $response = $this->get(route('profile.index'));

        $response->assertRedirect(route('login'));
    }

    public function testUnauthUserCantUpdateProfiles()
    {
        $response = $this->from(route('profile.index'))
            ->patch(route('profile.update', $this->users[0]->id));

        $response->assertRedirect(route('login'));
    }

    public function testUserCantUpdateAnotherUserProfile()
    {
        \Auth::loginUsingId($this->users[0]->id);

        $response = $this->from(route('profile.index'))
            ->patch(route('profile.update', $this->users[1]->id));

        $response->assertForbidden();
    }

}
