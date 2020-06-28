<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\UserGroup;
use App\Services\Repositories\UserGroupRepository;
use App\Services\UserGroupsService;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\Generators\ArticleDataGenerator;
use Tests\Generators\UserGenerator;
use App\Http\Controllers\Admin\Requests\UpdateArticleRequest;
use App\Http\Controllers\Admin\Requests\StoreArticleRequest;
use Tests\TestCase;
use App\Models\User;
use Mockery;

/**
 * Проверка прав доступа к действиям Admin\ArticlesController
 *
 * Class AdminArticlesControllerAccessTest
 * @package Tests\Feature
 */
class AdminArticlesControllerAccessTest extends TestCase
{
    //use WithoutMiddleware;

    use DatabaseTransactions;
    use WithFaker;

    /**
     * @var UserGroupsService|mixed
     */
    private $userGroupsService;

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
        $this->userGroupsService = \App::make(UserGroupsService::class);
        $this->userGenerator = \App::make(UserGenerator::class);
    }

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Проверка доступа к просмотру всех статей
     *
     * @dataProvider userDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToIndexAction(User $user)
    {
        $this->actingAs($user);
        $response = $this->get(route('articles.index'));
        if ($user->can('hasAdminAccess')) {
            $response->assertStatus(Response::HTTP_OK);
            $response->assertViewHas('articles');
        } else {
            $response->assertStatus(Response::HTTP_FOUND);
            $response->assertRedirect('/');
        }
    }

    /**
     * Проверка доступа на получение данных
     * для формы редактирования статьи
     *
     * @dataProvider userDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToEditAction(User $user)
    {
        $article = factory(Article::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('articles.edit', $article));

        if ($user->can('hasAdminAccess')) {
            if ($user->can('update', $article)) {
                $response->assertStatus(Response::HTTP_OK);
                $response->assertJson(['id' => true, 'title' => true, 'intro_text' => true, 'full_text' => true, 'category_id' => true]);
            } else {
                $response->assertStatus(Response::HTTP_FORBIDDEN);
            }
        } else {
            $response->assertStatus(Response::HTTP_FOUND);
            $response->assertRedirect('/');
        }
    }

    /**
     * Проверка доступа на изменение статьи
     *
     * @dataProvider userDataProvider
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

        if ($user->can('hasAdminAccess')) {
            if ($user->can('update', $article)) {
                $response->assertStatus(Response::HTTP_OK);
                $response->assertJson(['status' => 'ok', 'redirect' => route('articles.index')]);
            } else {
                $response->assertStatus(Response::HTTP_FORBIDDEN);
            }
        } else {
            $response->assertStatus(Response::HTTP_FOUND);
            $response->assertRedirect('/');
        }
    }

    /**
     * Проверка доступа на удаление статьи
     *
     * @dataProvider userDataProvider
     * @param User $user
     * @return void
     */
    public function testAccessToDestroyAction(User $user)
    {
        $article = factory(Article::class)->create();
        $this->actingAs($user);
        $response = $this->delete(route('articles.destroy', $article));

        if ($user->can('hasAdminAccess')) {
            if ($user->can('delete', $article)) {
                $response->assertStatus(Response::HTTP_FOUND);
                $response->assertRedirect(route('articles.index'));
            } else {
                $response->assertStatus(Response::HTTP_FORBIDDEN);
            }
        } else {
            $response->assertStatus(Response::HTTP_FOUND);
            $response->assertRedirect('/');
        }
    }

    /**
     * Формирование тестовых пользователей
     * @return array
     */
    public function userDataProvider()
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
            UserGroup::REGISTERED_GROUP => [
                $this->userGenerator->createUser(UserGroup::REGISTERED_GROUP)
            ],
            UserGroup::BLOCKED_GROUP => [
                $this->userGenerator->createUser(UserGroup::BLOCKED_GROUP)
            ],
        ];
    }
}
