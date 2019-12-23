<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
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
     * Create User instance.
     *
     * @param  array  $data
     * @return User
     */
    private function createUser(array $data = []): User
    {
        return factory(User::class)->create($data);
    }

    /**
     * Data Provider: invalid E-mail.
     *
     * @return array
     */
    public function invalidEmailProvider()
    {
        return [
            ['qwerty'],
            [''],
            [' '],
            ['@test'],
        ];
    }

    /**
     * Data Provider: invalid password.
     *
     * @return array
     */
    public function invalidPasswordProvider()
    {
        return [
            [''],
            [' '],
            ['123456'],
        ];
    }

    /**
     * Test 'login' route (not authorized).
     *
     * @return void
     */
    public function testLoginRouteNotAuthorized()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /**
     * Test 'login' route (authorized).
     *
     * @return void
     */
    public function testLoginRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('login'));
        $response->assertStatus(302);
        $response->assertRedirect(route('backend'));
    }

    /**
     * Test 'login' form (empty values).
     *
     * @return void
     */
    public function testLoginFormEmptyValues()
    {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);
        $user = $this->createUser($data);

        $data = [];

        $response = $this->post(route('login'), $data);
        $response->assertSessionHasErrors([
            'email',
        ]);
    }

    /**
     * Test 'login' form (invalid email).
     *
     * @dataProvider invalidEmailProvider
     * @return void
     */
    public function testLoginFormInvalidEmail($email)
    {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);
        $user = $this->createUser($data);

        unset($data['name']);
        $data['email'] = $email;

        $response = $this->post(route('login'), $data);
        $response->assertSessionHasErrors([
            'email',
        ]);
    }

    /**
     * Test 'login' form (wrong password).
     *
     * @return void
     */
    public function testLoginFormWrongPassword()
    {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);
        $user = $this->createUser($data);

        unset($data['name']);
        $data['password'] = '123';

        $response = $this->post(route('login'), $data);
        $response->assertSessionHasErrors([
            'email',
        ]);
    }

    /**
     * Test 'login' form (correct values).
     *
     * @return void
     */
    public function testLoginForm()
    {
        $data = self::DEFAULT_DATA;
        $data['password'] = Hash::make($data['password']);
        $user = $this->createUser($data);

        unset($data['name']);

        $response = $this
            ->actingAs($user)
            ->post(route('login'), $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('backend'));
    }

    /**
     * Test 'register' route (not authorized).
     *
     * @return void
     */
    public function testRegisterRouteNotAuthorized()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    /**
     * Test 'register' route (authorized).
     *
     * @return void
     */
    public function testRegisterRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('register'));
        $response->assertStatus(302);
        $response->assertRedirect(route('backend'));
    }

    /**
     * Test 'register' form (empty values).
     *
     * @return void
     */
    public function testRegisterFormEmptyValues()
    {
        $data = [];
        $response = $this->post(route('register'), $data);
        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);
    }

    /**
     * Test 'register' form (invalid email).
     *
     * @dataProvider invalidEmailProvider
     * @return void
     */
    public function testRegisterFormInvalidEmail($email)
    {
        $data = self::DEFAULT_DATA;
        $data['email'] = $email;
        $response = $this->post(route('register'), $data);
        $response->assertSessionHasErrors([
            'email',
        ]);
    }

    /**
     * Test 'register' form (invalid password).
     *
     * @dataProvider invalidPasswordProvider
     * @return void
     */
    public function testRegisterFormInvalidPassword($password)
    {
        $data = self::DEFAULT_DATA;
        $data['password'] = $password;
        $response = $this->post(route('register'), $data);
        $response->assertSessionHasErrors([
            'password',
        ]);
    }

    /**
     * Test 'register' form.
     *
     * @dataProvider invalidPasswordProvider
     * @return void
     */
    public function testRegisterForm()
    {
        $data = self::DEFAULT_DATA;
        $data['password_confirmation'] = $data['password'];
        $response = $this->post(route('register'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect(route('backend'));
    }

    /**
     * Test 'logout' route (not authorized).
     *
     * @return void
     */
    public function testLogoutRouteNotAuthorized()
    {
        $response = $this->post(route('logout'));
        $response->assertStatus(302);
        $response->assertRedirect('');
    }

    /**
     * Test 'logout' route (authorized).
     *
     * @return void
     */
    public function testLogoutRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->post(route('logout'));
        $response->assertStatus(302);
        $response->assertRedirect('');
    }

    /**
     * Test 'password.request' route (not authorized).
     *
     * @return void
     */
    public function testPasswordResetRouteNotAuthorized()
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200);
    }

    /**
     * Test 'password.request' route (authorized).
     *
     * @return void
     */
    public function testPasswordResetRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('password.request'));
        $response->assertStatus(302);
        $response->assertRedirect('backend');
    }

    /**
     * Test 'password.request' form (invalid email).
     *
     * @dataProvider invalidEmailProvider
     * @return void
     */
    public function testPasswordResetFormInvalidEmail($email)
    {
        $data = [
            'email' => $email,
        ];
        $response = $this->post(route('password.request'), $data);
        $response->assertSessionHasErrors([
            'email',
        ]);
    }

    /**
     * Test 'password.email' form.
     *
     * @return void
     */
    public function testPasswordResetForm()
    {
        $user = $this->createUser();
        $data = [
            'email' => $user->email,
        ];
        $response = $this->post(route('password.email'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('');
    }

}
