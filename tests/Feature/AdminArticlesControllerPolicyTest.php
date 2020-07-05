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
 * Проверка политик доступа к действиям Admin\ArticlesController
 *
 * Class AdminArticlesControllerPolicyTest
 * @package Tests\Feature
 */
class AdminArticlesControllerPolicyTest extends TestCase
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
     * Проверка доступа к просмотру всех статей
     * для пользователей с доступом к админке
     *
     * @dataProvider usersWithAdminAccessDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToIndexAction(User $user)
    {
        $this->actingAs($user);
        $response = $this->get(route('articles.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewHas('articles');
    }

    /**
     * Проверка доступа на получение данных
     * для формы редактирования статьи
     *
     * @dataProvider usersWithAdminAccessDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToEditAction(User $user)
    {
        $article = factory(Article::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('articles.edit', $article));
        if ($user->can('update', $article)) {
            $response->assertStatus(Response::HTTP_OK);
            $response->assertJson(['id' => true, 'title' => true, 'intro_text' => true, 'full_text' => true, 'category_id' => true]);
        } else {
            $response->assertStatus(Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Проверка доступа на изменение статьи
     *
     * @dataProvider usersWithAdminAccessDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToUpdateAction(User $user)
    {
        $article = factory(Article::class)->create();
        $this->actingAs($user);
        $response = $this->json('PUT', route('articles.update', $article),
            ['title' => $article->title, 'intro_text' => $article->intro_text, 'category_id' => $article->category_id]
        );
        if ($user->can('update', $article)) {
            $response->assertStatus(Response::HTTP_OK);
            $response->assertJson(['status' => 'ok', 'redirect' => route('articles.index')]);
        } else {
            $response->assertStatus(Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Проверка доступа на удаление статьи
     *
     * @dataProvider usersWithAdminAccessDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToDestroyAction(User $user)
    {
        $article = factory(Article::class)->create();
        $this->actingAs($user);
        $response = $this->delete(route('articles.destroy', $article));
        if ($user->can('delete', $article)) {
            $response->assertStatus(Response::HTTP_FOUND);
            $response->assertRedirect(route('articles.index'));
        } else {
            $response->assertStatus(Response::HTTP_FORBIDDEN);
        }
    }


    /**
     * Формирование тестовых пользователей c правами доступа к админке
     * @return array
     */
    public function usersWithAdminAccessDataProvider()
    {
        return [
            UserGroup::ADMIN_GROUP => [
                $this->userGenerator->createUser(UserGroup::ADMIN_GROUP)
            ],
            UserGroup::AUTHOR_GROUP => [
                $this->userGenerator->createUser(UserGroup::AUTHOR_GROUP)
            ],
            UserGroup::EDITOR_GROUP => [
                $this->userGenerator->createUser(UserGroup::EDITOR_GROUP)
            ],
            UserGroup::MODERATOR_GROUP => [
                $this->userGenerator->createUser(UserGroup::MODERATOR_GROUP)
            ],
        ];
    }
}
