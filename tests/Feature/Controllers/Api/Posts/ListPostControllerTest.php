<?php

namespace Tests\Feature\Controllers\Api\Posts;

use App\Models\EducationYear;
use App\Services\Helpers\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\Generators\GroupGenerator;
use Tests\Generators\PostGenerator;
use Tests\TestCase;
use Tests\Traits\ApiAuth;

/**
 * Class ListPostControllerTest
 * GET v1.0.0/posts
 * @package Tests\Feature\Controllers\Api\Posts
 * @group api_posts
 */
class ListPostControllerTest extends TestCase
{
    use ApiAuth;
    use RefreshDatabase;

    const BASE_URL = 'v1.0.0/posts/';

    private $group;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\RoleSeeder::class);
        $this->seed(\EducationYearSeeder::class);
        $this->group = GroupGenerator::generateGroup([
            'education_year_id' => EducationYear::current()->first()->id,
        ]);
    }

    public function testGet200WithoutQueryParams(): void
    {
        $this->authByMethodist();

        $this->json(Request::METHOD_GET, static::BASE_URL)
            ->assertOk();
    }

    public function testGet422IfTitleNotString(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => [],
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet200IfTitleIsString(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => 'test',
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_OK);
    }

    public function testGet422IfGroupsNotArray(): void
    {
        $this->authByMethodist();

        $data = [
            'groups' => 'string',
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfGroupsItemsNotInteger(): void
    {
        $this->authByMethodist();

        $data = [
            'groups' => ['test'],
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfGroupNotExist(): void
    {
        $this->authByMethodist();

        $data = [
            'groups' => [1],
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet200IfGroupsItemsIsIntegerAndExist(): void
    {
        $this->authByMethodist();

        $data = [
            'groups' => [$this->group->id],
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_OK);
    }

    public function testGet422IfPublishedNotBool(): void
    {
        $this->authByMethodist();

        $data = [
            'published' => [],
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet200IfPublishedIsFalse(): void
    {
        $this->authByMethodist();
        $post = PostGenerator::generatePublishedPost();
        PostGenerator::generatePublishedPost(false);

        $data = [
            'published' => false,
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(2, 'data');
    }

    public function testGet200IfPublishedIsTrue(): void
    {
        $this->authByMethodist();
        $post = PostGenerator::generatePublishedPost();
        PostGenerator::generatePublishedPost(false);

        $data = [
            'published' => true,
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' =>[['id' => $post->id]]
            ]);
    }

    public function testGet422IfLimitNotInteger(): void
    {
        $this->authByMethodist();

        $data = [
            'limit' => [],
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfLimitToSmall(): void
    {
        $this->authByMethodist();

        $data = [
            'limit' => 0,
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfLimitToBig(): void
    {
        $this->authByMethodist();

        $data = [
            'limit' => Settings::PER_PAGE + 1,
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfLimitExist(): void
    {
        $this->authByMethodist();
        PostGenerator::generatePublishedPost();
        PostGenerator::generatePublishedPost();

        $data = [
            'limit' => 1,
        ];

        $this->json(Request::METHOD_GET, static::BASE_URL, $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data');
    }

    public function testGetResource(): void
    {
        $this->authByMethodist();
        $post = PostGenerator::generatePublishedPost();

        $this->json(Request::METHOD_GET, static::BASE_URL)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    [
                        'id' => $post->id,
                        'title' => $post->title,
                        'body' => null,
                        'published_at' => $post->published_at->format('Y-m-d H:i:s'),
                        'user_id' => $post->user_id,
                        'producer' => [
                            'id' => $post->producer->id,
                            'last_name' => $post->producer->last_name,
                            'name' => $post->producer->name,
                            'second_name' => $post->producer->second_name,
                            'email' => $post->producer->email,
                            'role_id' => $post->producer->role_id,
                            'role' => [
                                'id' => $post->producer->role->id,
                                'name' => $post->producer->role->name,
                            ],
                        ],
                        'groups' => [
                            [
                                'id' => $post->groups->first()->id,
                                'number' => $post->groups->first()->number,
                                'course_id' => $post->groups->first()->course_id,
                                'education_year_id' => $post->groups->first()->education_year_id,
                            ]
                        ],
                    ],
                ]
            ]);
    }

    /**
     * @return string
     */
    private function getUri(): string
    {
        return static::BASE_URL;
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {
        return Request::METHOD_GET;
    }
}
