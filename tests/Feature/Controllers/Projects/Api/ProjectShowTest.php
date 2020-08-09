<?php

namespace Tests\Feature\Controllers\Projects\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\ProjectGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class ProjectShowTest
 *
 * @group api
 * @group projects
 * @group projects.api
 * @group projects.api.show
 * @package Tests\Feature\Controllers\Users\Api
 */
class ProjectShowTest extends TestCase
{

    public function testGetReturn401IfNoUser()
    {
        $project = ProjectGenerator::generateProject();

        $this->json(
            'GET',
            route('api.projects.show', ['project' => $project->id])
        )->assertStatus(401);
    }

    public function testGetProjectData()
    {
        $user = UserGenerator::generateAdmin();
        $project = ProjectGenerator::generateProject();

        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('api.projects.show', ['project' => $project->id])
        )->assertStatus(200);

        $response->assertJsonFragment(['name' => $project->name]);
    }

    public function testGet404ProjectData()
    {
        $user = UserGenerator::generateAdmin();

        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('api.projects.show', ['project' => rand()])
        )->assertStatus(404);
    }

}
