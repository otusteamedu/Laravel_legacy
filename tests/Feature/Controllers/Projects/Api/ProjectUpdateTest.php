<?php

namespace Tests\Feature\Controllers\Projects\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\ProjectGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class ProjectUpdateTest
 *
 * @group api
 * @group projects
 * @group projects.api
 * @group projects.api.update
 * @package Tests\Feature\Controllers\Users\Api
 */
class ProjectUpdateTest extends TestCase
{

    private function makeUpData(): array
    {
        $project = ProjectGenerator::generateProject();
        return [
            'project' => $project->id,
            'name' => $this->faker->name
        ];
    }

    public function testPutReturn401IfNoUser()
    {
        $this->json(
            'PUT',
            route('api.projects.update', $this->makeUpData())
        )->assertStatus(401);
    }

    public function testPutUpdateProjectCheckJson()
    {
        $user = UserGenerator::generateAdmin();
        $upData = $this->makeUpData();

        Passport::actingAs($user);

        $response = $this->json(
            'PUT',
            route('api.projects.update', $upData)
        )->assertStatus(200);

        $response->assertJsonFragment(['name' => $upData['name']]);
    }

    public function testPutUpdateProjectCheckDb()
    {
        $user = UserGenerator::generateAdmin();
        $upData = $this->makeUpData();

        Passport::actingAs($user);

        $response = $this->json(
            'PUT',
            route('api.projects.update', $upData)
        )->assertStatus(200);

        $this->assertDatabaseHas('projects', ['name' => $upData['name']]);
    }

    public function testPutUpdateProjectWithoutName()
    {
        $project = ProjectGenerator::generateProject();

        $user = UserGenerator::generateAdmin();

        Passport::actingAs($user);

        $response = $this->json(
            'POST',
            route('api.projects.store', ['project' => $project->id])
        )->assertStatus(422);

        $response->assertJsonStructure(['message', 'errors']);
    }

}
