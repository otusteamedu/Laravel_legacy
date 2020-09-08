<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\Requests\LoginRequest;
use App\Http\Middleware\ActivityLog;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;


/**
 * Проверка работы Api\V1\LoginController
 *
 * Class ApiLoginControllerTest
 * @package Tests\Feature\Api
 */
class ApiLoginControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * @var UserGenerator|mixed
     */
    private $userGenerator;

    /**
     * @var mixed
     */
    private $validator;

    /**
     * @var array
     */
    private $loginRules;

    /**
     * AdminArticlesControllerActionsTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->userGenerator = \App::make(UserGenerator::class);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->validator = app()->get('validator');
        $this->loginRules = (new LoginRequest())->rules();
        $this->withoutMiddleware(ActivityLog::class);
    }

    /**
     * Проверка авторизации пользователя
     *
     * @group api
     * @return void
     */
    public function testLoginAction()
    {
        $user = $this->userGenerator->createUserByParams([
            'password' => bcrypt($password = $this->faker->password(8))
        ]);
        $response = $this->json('POST', route('api.login'),
            ['email' => $user->email, 'password' => $password]);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Проверка авторизации пользователя с неверными данными
     *
     * @group api
     * @return void
     */
    public function testInvalidLoginAction()
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $response = $this->json('POST', route('api.login'),
            ['email' => $user->email, 'password' => $this->faker->password(8)]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['message' => 'Invalid credentials']);
        $this->assertGuest();
    }
}
