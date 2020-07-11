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
 * Проверка работы Admin\ArticlesController
 *
 * Class AdminArticlesControllerActionsTest
 * @package Tests\Feature
 */
class AdminArticlesControllerActionsTest extends TestCase
{
    //use WithoutMiddleware;

    use DatabaseTransactions;
    use WithFaker;

    /**
     * @var UserGenerator|mixed
     */
    private $userGenerator;

    /**
     * @var mixed|ArticleDataGenerator
     */
    private $articleDataGenerator;

    /**
     * @var mixed
     */
    private $validator;

    /**
     * @var array
     */
    private $updateRules;

    /**
     * @var array
     */
    private $storeRules;

    /**
     * AdminArticlesControllerActionsTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->createApplication();
        $this->userGenerator = \App::make(UserGenerator::class);
        $this->articleDataGenerator = \App::make(ArticleDataGenerator::class);

    }

    public function setUp(): void
    {
        parent::setUp();
        $this->validator = app()->get('validator');
        $this->updateRules = (new UpdateArticleRequest())->rules();
        $this->storeRules = (new StoreArticleRequest())->rules();
    }


    /**
     * Проверка создания статьи c валидными данными
     *
     * @dataProvider validDataProvider
     * @param $data //данные
     * @return void
     */
    public function testStoreDataWithValidValues(array $data)
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $this->actingAs($user);
        $this->assertDatabaseMissing('articles', $data);
        $response = $this->json('POST', route('articles.store'), $data);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('articles', $data);
        $response->assertJson(['status' => 'ok', 'redirect' => route('articles.index')]);
    }

    /**
     * Проверка создания статьи c невалидными данными
     *
     * @dataProvider invalidDataProvider
     * @param $validationTarget //объект валидации
     * @param array $data //данные
     * @return void
     */
    public function testStoreDataWithInvalidValues($validationTarget, array $data)
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $this->actingAs($user);
        $this->assertDatabaseMissing('articles', $data);
        $response = $this->json('POST', route('articles.store'), $data);
        $this->assertDatabaseMissing('articles', $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(false, $this->storeValidate($data));
        $response->assertJsonValidationErrors($validationTarget);
    }

    /**
     * Проверка удаления статьи
     *
     * @return void
     */
    public function testDestroyData()
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $this->actingAs($user);
        $article = factory(Article::class)->create();
        $response = $this->delete(route('articles.destroy', $article));
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDeleted('articles', ['id' => $article->id]);
        $response->assertRedirect(route('articles.index'));
    }

    /**
     * Проверка удаления несуществующей статьи
     *
     * @return void
     */
    public function testDestroyNotExistArticle()
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $this->actingAs($user);
        $response = $this->delete(route('articles.destroy', -1));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }


    /**
     * Проверка изменения статьи валидными данным
     *
     * @dataProvider validDataProvider
     * @param $data //данные
     * @return void
     */
    public function testUpdateDataWithValidValues(array $data)
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $this->actingAs($user);
        $article = factory(Article::class)->create();
        $response = $this->json('PUT', route('articles.update', $article), $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => 'ok', 'redirect' => route('articles.index')]);
    }

    /**
     * Проверка изменения статьи невалидными данными
     *
     * @dataProvider invalidDataProvider
     * @param $validationTarget //объект валидации
     * @param array $data //данные
     * @return void
     */
    public function testUpdateDataWithInvalidValues($validationTarget, array $data)
    {
        $user = $this->userGenerator->createUser(UserGroup::ADMIN_GROUP);
        $this->actingAs($user);
        $article = factory(Article::class)->create();
        $response = $this->json('PUT', route('articles.update', $article), $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(false, $this->updateValidate($data));
        $response->assertJsonValidationErrors($validationTarget);
    }

    /**
     * Формирование валидных данных для модели Article
     *
     * @return array
     */
    public function validDataProvider()
    {
        return [
            'valid_data' => [
                'data' => $this->articleDataGenerator->generateValidData()
            ]
        ];
    }

    /**
     * Формирование невалидных данных для модели Article
     *
     * @return array
     */
    public function invalidDataProvider()
    {
        return [
            'title_error' => [
                'target' => 'title',
                'data' => $this->articleDataGenerator->generateInvalidTitleData()
            ],
            'intro_text_error' => [
                'target' => 'intro_text',
                'data' => $this->articleDataGenerator->generateInvalidIntroTextData()
            ],
            'category_error' => [
                'target' => 'category_id',
                'data' => $this->articleDataGenerator->generateInvalidCategoryData()
            ],
        ];
    }

    /**
     * Проверка валидации по правилам из StoreArticleRequest
     * @param $data
     * @return mixed
     */
    protected function storeValidate($data)
    {
        return $this->validator
            ->make($data, $this->storeRules)
            ->passes();
    }

    /**
     * Проверка валидации по правилам из UpdateArticleRequest
     *
     * @param $data
     * @return mixed
     */
    protected function updateValidate($data)
    {
        return $this->validator
            ->make($data, $this->updateRules)
            ->passes();
    }
}
