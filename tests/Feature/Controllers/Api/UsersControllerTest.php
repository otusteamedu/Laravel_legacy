<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    private function getAddedUserResultByApi () {
        $stubPassword = '1234567890';
        $user = UserGenerator::createSimpleUser(['password' => \Hash::make($stubPassword)]);
        $apiToken = json_decode($this->json(
            'GET',
            route('api.personal.user.token'),
            [
                'email' => $user->email,
                'password' => $stubPassword
            ],
            [
                'Accept' => 'application/json'
            ]
        )->getContent())->api_token;

        return [
            'user' => $user,
            'api_token' => $apiToken
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        \Artisan::call('passport:install', ['-vvv' => true]);
    }

    /**
     * @group api
     */
    public function testGetPassportToken_WithoutEmailAndPassword()
    {
        $this->json('get', route('api.personal.user.token'))->assertStatus(400);
    }

    /**
     * @group api
     */
    public function testGetPassportToken_WithEmailAndPassword()
    {
        $stubPassword = '1234567890';
        $user = UserGenerator::createSimpleUser(['password' => \Hash::make($stubPassword)]);

        $this->json(
            'GET',
            route('api.personal.user.token'),
            [
                'email' => $user->email,
                'password' => $stubPassword
            ],
            [
                'Accept' => 'application/json'
            ]
        )->assertStatus(200)
            ->assertJsonStructure([
                'api_token',
            ]);
    }

    /**
     * @group api
     */
    public function testRegisterUser()
    {
        $data = UserGenerator::generateUserCreateData();
        $data['email'] = 'test' . time() . '@google.ru';

        $this->json(
            'POST',
            route('api.user.register'),
            $data,
            [
                'Accept' => 'application/json'
            ]
        )->assertStatus(201)
            ->assertJsonStructure(['id', 'email', 'phone']);

        $this->assertEquals(1, User::where('email', $data['email'])->count());
    }

    /**
     * @group api
     */
    public function testRegisterUser_WontCreateUserWithTheSameEmail()
    {
        $data = UserGenerator::generateUserCreateData();
        $data['email'] = 'test' . time() . '@yandex.ru';

        $this->json(
            'POST',
            route('api.user.register'),
            $data,
            [
                'Accept' => 'application/json'
            ]
        )->assertStatus(201)
            ->assertJsonStructure(['id', 'email', 'phone']);

        $data['phone'] = $data['phone'] . time();

        $this->json(
            'POST',
            route('api.user.register'),
            $data,
            [
                'Accept' => 'application/json'
            ]
        )->assertJsonStructure(['errors'])
            ->assertStatus(422);

        $this->assertEquals(1, User::where('email', $data['email'])->count());
    }

    /**
     * @group api
     */
    public function testUserLogout()
    {
        $apiToken = $this->getAddedUserResultByApi()['api_token'];

        $this->json(
            'POST',
            route('api.user.logout'),
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
            ]
        )->assertJsonStructure(['message'])
            ->assertJsonFragment(['message' => 'User logged out successfully'])
            ->assertStatus(200);
    }

    /**
     * @group api
     */
    public function testUserLogout_WithoutBearerHeader()
    {
        $this->json(
            'POST',
            route('api.user.logout'),
            [],
            [
                'Accept' => 'application/json',
            ]
        )->assertStatus(401);
    }

    /**
     * @group api
     */
    public function testGetUser()
    {
        $addedUserResult = $apiToken = $this->getAddedUserResultByApi();
        $user = $addedUserResult['user'];
        $apiToken = $addedUserResult['api_token'];

        $this->json(
            'GET',
            route('api.user.index'),
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
            ]
        )
            ->assertJsonFragment(
                [
                    'id' => (int)$user->id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ]
            )
            ->assertStatus(200);
    }

    /**
     * @group api
     */
    public function testGetUserEmail()
    {
        $addedUserResult = $apiToken = $this->getAddedUserResultByApi();
        $user = $addedUserResult['user'];
        $apiToken = $addedUserResult['api_token'];

        $this->json(
            'GET',
            route('api.user.email'),
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
            ]
        )
            ->assertJsonFragment(
                [
                    'email' => $user->email,
                ]
            )
            ->assertStatus(200);
    }

    /**
     * @group api
     */
    public function testGetUserPhone()
    {
        $addedUserResult = $apiToken = $this->getAddedUserResultByApi();
        $user = $addedUserResult['user'];
        $apiToken = $addedUserResult['api_token'];

        $this->json(
            'GET',
            route('api.user.phone'),
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
            ]
        )
            ->assertJsonFragment(
                [
                    'phone' => $user->phone,
                ]
            )
            ->assertStatus(200);
    }

    /**
     * @group api
     */
    public function testUpdateUser()
    {
        $addedUserResult = $apiToken = $this->getAddedUserResultByApi();
        $user = $addedUserResult['user'];
        $apiToken = $addedUserResult['api_token'];

        $newEmail = 'email' . time() . 'yandex.ru';
        $newPhone = '7909' . rand(0, 1000) . rand(0, 1000);
        $newPassword = md5($newEmail . $newPhone);

        $this->json(
            'PUT',
            route('api.user.update'),
            array_merge(
                $user->toArray(),
                [
                    'email' => $newEmail,
                    'phone' => $newPhone,
                    'password' => $newPassword,
                    'password_confirmation' => $newPassword,
                ]
            ),
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
            ]
        );

        $user->refresh();
        $newUser = User::whereId($user->id)->first();

        self::assertEquals($user->email, $newUser->email);
        self::assertEquals($user->phone, $newUser->phone);
    }
}
