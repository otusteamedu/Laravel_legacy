<?php

namespace Tests\Unit\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    public function testUserCreateTest()
    {
        $this->seed('LaratrustSeeder');

        $createUser = factory(User::class)->create([
            'email' => 'kobe@mail.com'
        ]);
        $createUser->attachRole('user');

        $dbUser = \App\Models\User::where('email', 'kobe@mail.com')->first();

        $this->assertEquals($createUser->id, $dbUser->id);
    }

    public function testUserHasRoleTest()
    {
        $user = factory(User::class)->create();
        $user->attachRole('user');

        $this->assertTrue($user->hasRole('user'));
    }

    public function testNotFoundTest()
    {
        $user = User::where('email', 'notfound@notfound.notfound')->first();

        $this->assertNull($user);
    }

    public function testDeleteUserRoleTest()
    {
        $user = factory(User::class)->create([
            'email' => 'bryant@mail.com'
        ]);
        $user->attachRole('user');

        $deleteRes = User::destroy($user->id);
        $userRole = DB::table('role_user')->where('user_id', $user->id)->first();

        $this->assertEquals($deleteRes, 1);
        $this->assertNull($userRole);
    }
}
