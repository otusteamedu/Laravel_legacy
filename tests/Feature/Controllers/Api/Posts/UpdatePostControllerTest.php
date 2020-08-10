<?php

namespace Tests\Feature\Controllers\Api\Posts;

use App\Models\EducationYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\Generators\GroupGenerator;
use Tests\Generators\PostGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\Traits\ApiAuth;

/**
 * PUT v1.0.0/posts/{id}
 * Class StorePostController
 * @package Tests\Feature\Controllers\Api\Posts
 * @group api_posts
 */
class UpdatePostControllerTest extends TestCase
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

    public function testGet401IfPostIsPublished(): void
    {
        $this->authByMethodist();
        $post = PostGenerator::generatePublishedPost();

        $data = [
            'title' => 'test',
            'body' => 'test',
            'groups' => [$this->group->id],
        ];

        $this->json(Request::METHOD_PUT, static::BASE_URL . $post->id, $data)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGet422IfTitleNotString(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => [],
            'body' => 'test',
            'groups' => [$this->group->id],
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfTitleNotExist(): void
    {
        $this->authByMethodist();

        $data = [
            'body' => 'test',
            'groups' => [$this->group->id],
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfBodyNotString(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => 'test',
            'body' => [],
            'groups' => [$this->group->id],
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfBodyNotExist(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => 'test',
            'groups' => [$this->group->id],
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfGroupsNotArray(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => 'test',
            'body' => 'test',
            'groups' => 'test',
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfGroupsNotExist(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => 'test',
            'body' => 'test',
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet422IfGroupsItemNotExist(): void
    {
        $this->authByMethodist();

        $data = [
            'title' => 'test',
            'body' => 'test',
            'groups' => [100],
        ];

        $this->json(Request::METHOD_PUT, $this->getUri(), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testGet200(): void
    {
        $this->authByMethodist();
        $post = PostGenerator::generatePublishedPost(false);

        $data = [
            'title' => 'test',
            'body' => 'test',
            'groups' => [$this->group->id],
        ];

        $response = $this->json(Request::METHOD_PUT, static::BASE_URL . $post->id, $data)
            ->assertStatus(Response::HTTP_OK);
        $post = $post->fresh();
        $response->assertJson([
                'data' => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'published_at' => null,
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
                ]
            ]);
    }

    /**
     * @return string
     */
    private function getUri(): string
    {
        UserGenerator::generateMethodist();
        $post = PostGenerator::generatePublishedPost(false);
        return static::BASE_URL . $post->id;
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {
        return Request::METHOD_PUT;
    }
}
