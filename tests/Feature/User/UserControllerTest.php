<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Services\User\Resources\User as UserResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

/**
 * Class UserControllerTest
 * @package Tests\Feature
 *
 * @group user
 * @group userController
 */
class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('LaratrustSeeder');
    }
    public function testIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertOk();
        $this->assertInstanceOf(Collection::class, $response->getOriginalContent());
        $this->assertJson($response->getContent());
    }

    public function testUserStore()
    {
        $data = [
            'name' => 'Dino',
            'email' => 'dino@doni.do',
            'password' => 'secret'
        ];

        $responseData = Arr::except($data,'password');

        $postData = Arr::collapse([$data, ['password_confirmation' => 'secret']]);

        $this->assertDatabaseMissing('users', $data);

        $response = $this->post(route('users.store'), $postData);

        $response->assertOk();
        $this->assertInstanceOf(User::class, $response->getOriginalContent());
        $this->assertJson($response->getContent());
        $this->assertDatabaseHas('users', $responseData);
        $this->assertNotEmpty(User::where('name', 'Dino')->get());
    }

    public function testUserShow()
    {
        $user = factory(User::class)->create([
            'name' => 'ForShow User'
        ]);

        $response = $this->get(route('users.show', $user->id));
        $response->assertOk();
        $this->assertInstanceOf(UserResource::class, $response->getOriginalContent());
        $this->assertJson($response->getContent());
        $this->assertEquals($response->getOriginalContent()->id, $user->id);
    }

    public function testUserUpdate()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt('password')
        ]);

        $role = 'administrator';
        $password = 'password';
        $newPassword = 'secret';

        $data = [
            'name' => 'Fake User',
            'email' => 'fake@user.com'
        ];

        $dataPassword = [
            'old_password' => $password,
            'password' => $newPassword,
            'password_confirmation' => $newPassword
        ];

        $dataRole = ['role' => $role];

        $response = $this->post(route('users.update', $user->id), Arr::collapse([$data, $dataPassword]));

        $response->assertOk();
        $this->assertInstanceOf(User::class, $response->getOriginalContent());
        $this->assertJson($response->getContent());
        $this->assertDatabaseHas('users', $data);

        $response = $this->post(route('users.update', $user->id), Arr::collapse([$data, $dataRole]));

        $user = User::findOrFail($user->id);
        $this->assertTrue($response->getOriginalContent()->hasRole($role));
        $this->assertTrue($user->hasRole($role));
    }

    public function testDestroy()
    {
        $data = [
            'name' => 'Fake User',
            'email' => 'fake@user.com'
        ];

        $user = factory(User::class)->create($data);

        $response = $this->delete(route('users.destroy', $user->id));

        $response->assertOk();
        $this->assertEquals($response->getContent(), 1);
        $this->assertDatabaseMissing('users', $data);
    }

    public function testPublish()
    {
        $user = factory(User::class)->create(['publish' => 1]);

        $response = $this->get(route('users.publish', $user->id));

        $response->assertOk();
        $this->assertInstanceOf(User::class, $response->getOriginalContent());
        $this->assertJson($response->getContent());
        $this->assertEquals($user->publish, 1);
        $this->assertEquals($response->getOriginalContent()->publish, 0);
    }
}
