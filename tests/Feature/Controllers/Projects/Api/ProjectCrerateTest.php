<?php

namespace Tests\Feature\Controllers\Projects\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\ProjectGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class ProjectCreateTest
 *
 * @group api
 * @group projects
 * @group projects.api
 * @group projects.api.create
 * @package Tests\Feature\Controllers\Users\Api
 */
class ProjectCreateTest extends TestCase
{

    public function testPostReturn401IfNoUser()
    {
        $project = ProjectGenerator::generateProjectMake();

        $this->json(
            'POST',
            route('api.projects.store', $project->toArray())
        )->assertStatus(401);
    }

    public function testPostCreateProjectCheckJson()
    {
        $user = UserGenerator::generateAdmin();
        $project = ProjectGenerator::generateProjectMake();

        Passport::actingAs($user);

        $response = $this->json(
            'POST',
            route('api.projects.store', $project->toArray())
        )->assertStatus(201);

        $response->assertJsonFragment(['name' => $project->name]);
    }

    public function testPostCreateProjectCheckDb()
    {
        $user = UserGenerator::generateAdmin();
        $project = ProjectGenerator::generateProjectMake();

        Passport::actingAs($user);

        $response = $this->json(
            'POST',
            route('api.projects.store', $project->toArray())
        )->assertStatus(201);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name,
        ]);
    }

    public function testPostCreateProjectWithoutName()
    {
        $user = UserGenerator::generateAdmin();

        Passport::actingAs($user);

        $response = $this->json(
            'POST',
            route('api.projects.store', [])
        )->assertStatus(422);

        $response->assertJsonStructure(['message', 'errors']);
    }

}
