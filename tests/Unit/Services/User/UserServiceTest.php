<?php

namespace Tests\Unit\Services\User;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Default values for User
     */
    const DEFAULT_DATA = [
        'name' => 'Test User',
        'email' => 'test@localhost',
        'password' => 'Str0ngPassw0rd',
    ];

    /**
     * @var UserService $userService
     */
    private $userService;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make('App\Services\User\UserService');
    }

    /**
     * Test UserService::create() method.
     *
     * @return void
     */
    public function testCreate(): void {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);

        $user = $this->userService->create($data);

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }

    /**
     * Test UserService::update() method.
     *
     * @return void
     */
    public function testUpdate(): void {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);

        $user = $this->userService->create($data);

        $data['name'] = 'Test User 2';
        $data['email'] = 'test2@localhost';

        $user = $this->userService->update($user, $data);

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }

    /**
     * Test UserService::findById() method.
     *
     * @return void
     */
    public function testFindById(): void {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);

        $user = $this->userService->create($data);

        $userFound = $this->userService->findById($user->id);
        $this->assertEquals($user->id, $userFound->id);
    }

    /**
     * Test UserService::delete() method.
     *
     * @return void
     */
    public function testDelete(): void {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);

        $user = $this->userService->create($data);
        $this->userService->delete($user);

        $userFound = $this->userService->findById($user->id);
        $this->assertNull($userFound);
    }

}
