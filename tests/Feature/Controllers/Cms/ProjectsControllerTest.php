<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\Project;
use App\Services\Projects\Repositories\ProjectRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\ProjectGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ProjectsControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getProjectRepository(): ProjectRepositoryInterface
    {
        return app()->make(ProjectRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group projects
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.projects.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group projects
     * @group testIndexWithProjects
     */
    public function testIndexWithProjects()
    {
        $project = ProjectGenerator::createProject();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.projects.index'))
            ->assertStatus(200)
            ->assertSeeText($project->name);
    }

    /**
     * @group cms
     * @group projects
     * @group testUnAuthicatedUserWontCreateProjectAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateProjectAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateProjectCreateData();
        $this->post(route('cms.projects.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group projects
     * @group testCreateProject
     * @return void
     */
    public function testCreateProject()
    {
        $data = $this->generateProjectCreateData();
        $this->createProject($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('projects', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(Project::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group projects
     * @group testCreateProjectFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateProjectFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.projects.store'), [
                'condition' => $this->faker->text,
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Project::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group projects
     * @group testCreateProjectFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateProjectFailsIfParamsAreEmpty()
    {
        $this->createProject([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Project::all()->count());
    }

    /**
     * @return array
     */
    private function generateProjectCreateData(): array
    {
        return [
            'name' => $this->faker->text(20),
            'condition' => $this->faker->text,
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createProject(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.projects.store'), $data);
    }

}
