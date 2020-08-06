<?php

namespace Tests\Feature\Controllers\Projects\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\ProjectGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class ProjectListTest
 *
 * @group api
 * @group projects
 * @group projects.api
 * @group projects.api.list
 * @package Tests\Feature\Controllers\Users\Api
 */
class ProjectListTest extends TestCase
{

    public function testGetReturn401IfNoUser()
    {
        $this->json(
            'GET',
            route('api.projects.index')
        )->assertStatus(401);
    }

    public function testGetProjectsList()
    {
        $user = UserGenerator::generateAdmin();
        $project = ProjectGenerator::generateProject();

        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('api.projects.index')
        )->assertStatus(200);

        $this->assertEquals($response->json('total'), 1);
        $response->assertJsonFragment(['name' => $project->name]);
    }

}
