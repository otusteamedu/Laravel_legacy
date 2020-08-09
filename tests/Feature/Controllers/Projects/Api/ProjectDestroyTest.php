<?php

namespace Tests\Feature\Controllers\Projects\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\ProjectGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class ProjectDestroyTest
 *
 * @group api
 * @group projects
 * @group projects.api
 * @group projects.api.destroy
 * @package Tests\Feature\Controllers\Users\Api
 */
class ProjectDestroyTest extends TestCase
{

    public function testDeleteReturn401IfNoUser()
    {
        $project = ProjectGenerator::generateProject();

        $this->json(
            'DELETE',
            route('api.projects.destroy', ['project' => $project->id])
        )->assertStatus(401);
    }

    public function testDeleteProjectCheckJson()
    {
        $user = UserGenerator::generateAdmin();
        $project = ProjectGenerator::generateProject();

        Passport::actingAs($user);

        $response = $this->json(
            'DELETE',
            route('api.projects.destroy', ['project' => $project->id])
        )->assertStatus(200);

        $response->assertJson(['status' => true]);
    }

    public function testDeleteProjectCheckDb()
    {
        $user = UserGenerator::generateAdmin();
        $project = ProjectGenerator::generateProject();

        Passport::actingAs($user);

        $this->json(
            'DELETE',
            route('api.projects.destroy', ['project' => $project->id])
        )->assertStatus(200);

        $this->assertDatabaseMissing('projects', ['id' => $project->id, 'deleted_at' => null]);
    }
}
