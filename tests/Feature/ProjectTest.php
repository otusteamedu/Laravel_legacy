<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function testNoAccessToProjectsForGuest()
    {
        $this->get(route('projects.index'))
            ->assertRedirect('/login');
    }

    public function testSeeProjectInList()
    {
        $user = factory(User::class)->create();
        $project = $this->generateProjectForUser($user);

        $response = $this->actingAs($user)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertSee($project->git);
    }

    public function testDonSeeOthersProjectInList()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertDontSee($project->git);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('projects.create'))
            ->assertStatus(200)
            ->assertSee(trans('projects.title_create'))
            ->assertSee(trans('projects.form.create'));
    }

    public function testStore()
    {
        $user = factory(User::class)->create();

        $git = 'https://github.com/phptrack/store';
        $response = $this->actingAs($user)
            ->post(route('projects.store'), ['git' => $git]);

        $this->assertCount(1, Project::all());

        /** @var Project $project */
        $project = Project::where(['git' => $git])->first();
        $this->assertNotEmpty($project);
        $this->assertTrue($project->hasUser($user));

        $response->assertRedirect(route('projects.show', $project));
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $project = $this->generateProjectForUser($user);

        $this->actingAs($user)
            ->get(route('projects.edit', $project))
            ->assertStatus(200)
            ->assertSee(trans('projects.form.update'));
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $project = $this->generateProjectForUser($user);

        $newGit = 'https://github.com/phptrack/update';
        $this->actingAs($user)
            ->patch(route('projects.update', $project), ['git' => $newGit])
            ->assertRedirect(route('projects.edit', $project));

        /** @var Project $project */
        $project->refresh();
        $this->assertEquals($newGit, $project->git);
    }

    public function testCantUpdateOthersProject()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $project = $this->generateProjectForUser($otherUser);

        $this->actingAs($user)
            ->patch(route('projects.update', $project), ['git' => 'dummy'])
            ->assertStatus(403);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $project = $this->generateProjectForUser($user, ['git' => 'https://github.com/phptrack/destroy']);

        $this->actingAs($user)
            ->delete(route('projects.destroy', $project))
            ->assertRedirect(route('projects.index'))
            ->assertSessionHas('success', trans('projects.delete_success', ['git' => $project->git]));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function testCantDeleteOthersProject()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $project = $this->generateProjectForUser($otherUser);

        $this->actingAs($user)
            ->delete(route('projects.destroy', $project))
            ->assertStatus(403);

        $project->refresh();
    }

    public function testCommits()
    {
        $user = factory(User::class)->create();
        $project = $this->generateProjectForUser($user);

        $this->actingAs($user)
            ->get(route('projects.commits', $project))
            ->assertStatus(200);
    }

    private function generateProjectForUser(User $user, array $data = []): Project
    {
        $project = factory(Project::class)->create($data);
        $project->users()->attach($user);
        return $project;
    }

}
