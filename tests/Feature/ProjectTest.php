<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Jobs\ProjectHistoryJob;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\Generators\ProjectGenerator;
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
        $project = ProjectGenerator::createForUser($user);

        $response = $this->actingAs($user)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertSee($project->url);
    }

    public function testDonSeeOthersProjectInList()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertDontSee($project->url);
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

        $this->withoutMiddleware(VerifyCsrfToken::class);

        Queue::fake();

        $url = 'https://github.com/phptrack/store';
        $response = $this->actingAs($user)
            ->post(route('projects.store'), ['url' => $url]);

        $this->assertCount(1, Project::all());

        /** @var Project $project */
        $project = Project::where(['url' => $url])->first();
        $this->assertNotEmpty($project);
        $this->assertTrue($project->hasUser($user));

        Queue::assertPushed(ProjectHistoryJob::class);

        $response->assertRedirect(route('projects.show', $project));
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($user);

        $this->actingAs($user)
            ->get(route('projects.edit', $project))
            ->assertStatus(200)
            ->assertSee(trans('projects.form.save'));
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($user);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        Queue::fake();

        $newUrl = 'https://github.com/phptrack/update';
        $this->actingAs($user)
            ->patch(route('projects.update', $project), ['url' => $newUrl])
            ->assertRedirect(route('projects.edit', $project));

        Queue::assertPushed(ProjectHistoryJob::class);

        /** @var Project $project */
        $project->refresh();
        $this->assertEquals($newUrl, $project->url);
    }

    public function testCantUpdateOthersProject()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($otherUser);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->patch(route('projects.update', $project), ['url' => 'dummy'])
            ->assertStatus(403);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($user);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('projects.destroy', $project))
            ->assertRedirect(route('projects.index'))
            ->assertSessionHas('success', trans('projects.delete_success', ['url' => $project->url]));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function testCantDeleteOthersProject()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($otherUser);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('projects.destroy', $project))
            ->assertStatus(403);
    }

    public function testCommits()
    {
        $user = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($user);

        $this->actingAs($user)
            ->get(route('projects.commits', $project))
            ->assertStatus(200);
    }

    public function testCommitNotFound()
    {
        $user = factory(User::class)->create();
        $project = ProjectGenerator::createForUser($user);
        $hash = str_repeat('0', 40);

        $this->actingAs($user)
            ->get(route('projects.commit', [$project, $hash]))
            ->assertRedirect(route('projects.commits', $project));
    }
}
