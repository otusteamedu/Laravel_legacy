<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use App\Models\User;

/**
 * Проверка gate hasAdminAccessTest
 *
 * Class GateHasAdminAccessTest
 * @package Tests\Feature
 */
class GateHasAdminAccessTest extends TestCase
{
    //use WithoutMiddleware;

    use DatabaseTransactions;
    use WithFaker;

    /**
     * @var UserGenerator|mixed
     */
    private $userGenerator;

    /**
     * AdminArticlesControllerTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->createApplication();
        $this->userGenerator = \App::make(UserGenerator::class);
    }

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Проверка доступа к действиям над статьями
     * для пользователей без доступа к админке
     *
     * @dataProvider usersWithoutAdminAccessDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToArticlesActions(User $user)
    {
        $this->actingAs($user);
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.index'));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');

        $response = $this->get(route('articles.edit', $article));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');

        $response = $this->json('PUT', route('articles.update', $article), [$article]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');

        $response = $this->delete(route('articles.destroy', $article));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');
    }

    /**
     * Формирование тестовых пользователей без прав доступа к админке
     * @return array
     */
    public function usersWithoutAdminAccessDataProvider()
    {
        return [
            UserGroup::REGISTERED_GROUP => [
                $this->userGenerator->createUser(UserGroup::REGISTERED_GROUP)
            ],
            UserGroup::BLOCKED_GROUP => [
                $this->userGenerator->createUser(UserGroup::BLOCKED_GROUP)
            ]
        ];
    }
}
