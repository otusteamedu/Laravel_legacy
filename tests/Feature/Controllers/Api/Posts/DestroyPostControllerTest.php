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
 * DELETE v1.0.0/posts/{id}
 * Class DestroyPostControllerTest
 * @package Tests\Feature\Controllers\Api\Posts
 * @group api_posts
 */
class DestroyPostControllerTest extends TestCase
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

    public function testGet200(): void
    {
        $this->authByMethodist();
        $post = PostGenerator::generatePublishedPost(false);
        $this->json(Request::METHOD_DELETE, static::BASE_URL . $post->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'published_at' => null,
                'user_id' => $post->user_id,
            ]
        ]);
    }

    /**
     * @return string
     */
    private function getUri(): string
    {
        UserGenerator::generateMethodist();
        $post = PostGenerator::generatePublishedPost();
        return static::BASE_URL . $post->id;
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {
        return Request::METHOD_DELETE;
    }
}
