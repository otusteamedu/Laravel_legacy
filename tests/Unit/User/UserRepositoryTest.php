<?php

namespace Tests\Unit\User;


use App\Models\User;
use App\Models\UserSocial;
use App\Models\VerifyUser;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

/**
 * Class UserRepositoryTest
 * @package Tests\Unit
 *
 * @group userRepo
 */
class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserRepository
     */
    private UserRepository $repo;

    /**
     * @var User
     */
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('LaratrustSeeder');
        $this->repo = resolve(UserRepository::class);
        $this->user = factory(User::class)->create();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $createUsersCount = 5;
        factory(User::class, $createUsersCount)->create();

        $users = $this->repo->index();

        $this->assertInstanceOf(Collection::class, $users);
        $this->assertGreaterThanOrEqual($createUsersCount, $users->count());
    }

    public function testShow()
    {
        $user = $this->repo->getItem($this->user->id);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($this->user->id, $user->id);

        $this->expectException(ModelNotFoundException::class);
        $this->repo->getItem(433234342);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'New Name',
            'email' => 'new@email.fake',
            'publish' => 0
        ];

        $updateUser = $this->repo->update($this->user, $data);

        $this->assertInstanceOf(User::class, $updateUser);
        $this->assertEquals($updateUser->id, $this->user->id);
        $this->assertEquals($updateUser->name, $data['name']);
        $this->assertEquals($updateUser->email, $data['email']);
    }

    public function testUpdateWithRole()
    {
        $data = [
            'name' => 'New Name',
            'email' => 'new@email.fake',
            'publish' => 0,
            'role' => 'administrator'
        ];

        $updateUser = $this->repo->update($this->user, $data);

        $this->assertInstanceOf(User::class, $updateUser);
        $this->assertEquals($updateUser->id, $this->user->id);
        $this->assertEquals($updateUser->name, $data['name']);
        $this->assertEquals($updateUser->email, $data['email']);
        $this->assertTrue($updateUser->hasRole('administrator'));
    }

    public function testSetPassword()
    {
        $oldPassword = 'password';
        $newPassword = 'drowssap';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword),
        ]);

        $this->repo->setPassword($user, $oldPassword, $newPassword);

        $this->assertTrue(password_verify($newPassword, $user->password));

        $this->expectException(HttpException::class);
        $this->expectErrorMessage(__('auth.wrong_active_password'));

        $this->repo->setPassword($user, 'secret', $newPassword);
    }

    public function testSetVerifyToken()
    {
        $this->repo->setVerifyToken($this->user);

        $verifyUser = VerifyUser::findOrFail($this->user->verifyUser->id);

        $this->assertInstanceOf(VerifyUser::class, $verifyUser);
    }

    public function testVerifyUser()
    {
        $response = $this->repo->verifyUser($this->user);

        $this->assertTrue($response);
        $this->assertInstanceOf(VerifyUser::class, $this->user->verifyUser);
    }

    public function testGetUserVerify()
    {
        $this->repo->verifyUser($this->user);

        $token = $this->user->verifyUser->token;

        $user = $this->repo->getUserVerify($token);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($this->user->id, $user->id);
        $this->assertEquals($token, $user->verifyUser->token);
    }

    public function testStoreUserSocial()
    {
        $service = 'facebook';
        $social_id = '134132443443§d';
        $userSocial = $this->repo->storeUserSocial($this->user, $social_id, $service);

        $this->assertInstanceOf(UserSocial::class, $userSocial);
        $this->assertEquals($service, $userSocial->service);
        $this->assertEquals($social_id, $userSocial->social_id);
    }
}
