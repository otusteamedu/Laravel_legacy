<?php

namespace Tests\Unit\User;

use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\CmsUserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

/**
 * Class UserServiceTest
 * @package Tests\Unit
 *
 * @group userService
 */
class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = resolve(CmsUserService::class);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserServiceIndex()
    {
        $users = factory(User::class, 5)->create();

        $userIds = Arr::pluck($users, 'id');

        $usersFromIndex = $this->service->index();

        $usersCount = $usersFromIndex->whereIn('id', $userIds)->count();

        $this->assertEquals($users->count(), $usersCount);
    }

    public function testUserServiceGetItemWithRole()
    {
        $this->seed('LaratrustSeeder');

        $user = factory(User::class)->create();
        $user->attachRole('user');

        $userFromService = $this->service->getItemWithRole($user->id);

        $this->assertTrue($userFromService->hasRole('user'));
    }

    public function testNotFoundUser()
    {
        $this->seed('LaratrustSeeder');

        factory(User::class)->create();

        $this->expectException('\Illuminate\Database\Eloquent\ModelNotFoundException');

        $this->service->getItem(23432434);
    }

    public function testStoreUser()
    {
        $request = new FormRequest;

        $request->merge([
            'name' => 'Fifty Forty',
            'email' => 'fiftyforty@gmail.gru',
            'password' => '111111'
        ]);

        $user = $this->service->store($request->all());

        $this->assertEquals('Fifty Forty', $user->name);
    }

    public function testUniqueFailStoreUser()
    {
        $request = new FormRequest;

        $request->merge([
            'name' => 'Fifty Forty',
            'email' => 'fiftyforty@gmail.gru',
            'password' => '111111'
        ]);

        factory(User::class)->create([
            'email' => 'fiftyforty@gmail.gru'
        ]);

        $this->expectException('\PDOException');

        $this->service->store($request->all());
    }

    public function testUpdateUser()
    {
        $request = new FormRequest;

        $request->merge([
            'name' => 'Diggi Don',
            'email' => 'diggi@don.ye',
            'password' => 'password'
        ]);

        $user = $this->service->store($request->all());

        $request->merge([
            'name' => 'Don Diggi Don',
            'role' => 'administrator',
            'old_password' => 'password',
            'password' => '111111',
            'publish' => 1
        ]);

        $updateUser = $this->service->update($user->id, $request->all());

        $this->assertTrue($updateUser->hasRole('administrator'));
    }

    public function testStoreWithSocial()
    {
        $request = new FormRequest;

        $request->merge([
            'name' => 'Diggi Don',
            'email' => 'diggi@don.ye',
            'password' => 'password',
            'social_id' => '2542452452'
        ]);

        $social = 'vkontakte';

        $user = $this->service->storeWithSocial($request->all(), $social);

        $services = $user->socials()->pluck('service');

        $this->assertTrue($services->contains('vkontakte'));
    }

    public function testStoreUserSocial()
    {
        $user = factory(User::class)->create([
            'email' => 'fiftyforty@gmail.gru'
        ]);

        $social = $this->service->storeUserSocial($user, '1343124h234', 'google');

        $this->assertEquals($social->service, 'google');
        $this->assertEquals($social->social_id, '1343124h234');
        $this->assertEquals($social->user_id, $user->id);
    }

    public function testGetUserBySocialId()
    {
        $request = new FormRequest;

        $social_id = '2542452452';

        $request->merge([
            'name' => 'Diggi Don',
            'email' => 'diggi@don.ye',
            'password' => 'password',
            'social_id' => $social_id
        ]);

        $social = 'vkontakte';

        $user = $this->service->storeWithSocial($request->all(), $social);

        $searchUser = $this->service->getUserBySocialId($social_id);

        $this->assertEquals($user->id, $searchUser->id);
    }

    public function testGetUserByEmail()
    {
        $request = new FormRequest;

        $email = 'diggi@don.ye';

        $request->merge([
            'name' => 'Diggi Don',
            'email' => $email,
            'password' => 'password'
        ]);

        $user = $this->service->store($request->all());

        $searchUser = $this->service->getUserByEmail($email);

        $this->assertEquals($user->id, $searchUser->id);
        $this->assertNull($this->service->getUserByEmail('asf@asdf.as'));
    }
}
