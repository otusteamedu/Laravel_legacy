<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use GroupSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ProjectTest
 *
 * @group   project
 * @package Tests\Feature
 */
class ProjectTest extends TestCase
{

    use WithFaker;

    /**
     * Тест просмотра списка проектов
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->actingAs($this->getUser())->get(route('projects.index'));
        $response->assertStatus(200);
    }

    /**
     * Получить пользователя
     *
     * @return User
     */
    protected function getUser(): User
    {
        static $user = null;

        if ($user) {
            return $user;
        }

        if (!Group::find(1)) {
            (new GroupSeeder())->run();
        }

        $this->clearUsers();

        $users = factory(User::class, 1)->create([
            'group_id' => Group::STAFF_ADMIN,
        ]);

        $user = $users->first();

        return $user;
    }

    /**
     * Удалить пользователей
     */
    protected function clearUsers()
    {
        User::withTrashed()->each(function (User $user) {
            $user->forceDelete();
        });
    }

    /**
     * Удалить пользователей
     */
    protected function clearProjects()
    {
        Project::withTrashed()->each(function (Project $project) {
            $project->forceDelete();
        });
    }

    /**
     * Тест просмотра страницы создания проекта
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->getUser())->get(route('projects.create'));
        $response->assertStatus(200);
    }

    /**
     * Тест создания проекта
     *
     * @return void
     */
    public function testStore()
    {
        $name = $this->faker->name;

        $this->actingAs($this->getUser());

        $response = $this->post(route('projects.store'), ['name' => $name]);
        $response->assertStatus(302);

        $response = $this->get(route('projects.index'));
        $response->assertSeeText($name);
    }

    /**
     * Тест просмотра страницы проекта
     *
     * @return void
     */
    public function testShow()
    {
        $projectId = $this->getProject()->id;

        $this->actingAs($this->getUser());

        $response = $this->get(route('projects.show', ['project' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);


        $response = $this->get(route('projects.show', ['project' => $projectId]));
        $response->assertStatus(200);
    }

    /**
     * Получить проект
     *
     * @return Project
     */
    protected function getProject(): Project
    {
        $projects = factory(Project::class, 1)->create();

        return $projects->first();
    }

    /**
     * Тест просмотра страницы редактирования проекта
     *
     * @return void
     */
    public function testEdit()
    {
        $projectId = $this->getProject()->id;

        $this->actingAs($this->getUser());

        $response = $this->get(route('projects.edit', ['project' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->get(route('projects.edit', ['project' => $projectId]));
        $response->assertStatus(200);

    }

    /**
     * Тест обновления проекта
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $projectId = $this->getProject()->id;

        $this->actingAs($this->getUser());

        $response = $this->put(route('projects.update', ['project' => $this->faker->numberBetween(100, 1000)]), $data);
        $response->assertStatus(404);

        $response = $this->put(route('projects.update', ['project' => $projectId]), $data);
        $response->assertStatus(302);

        $response = $this->get(route('projects.index'));
        $response->assertSeeText($data['name']);
    }

    /**
     * Тест удаления проекта
     *
     * @return void
     */
    public function testDelete()
    {
        $project = $this->getProject();
        $projectId = $project->id;

        $this->actingAs($this->getUser());

        $response = $this->get(route('projects.index'));
        $response->assertSee($project->name);

        $response = $this->delete(route('projects.destroy', ['project' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->delete(route('projects.destroy', ['project' => $projectId]));
        $response->assertStatus(302);

        $response = $this->get(route('projects.index'));
        $response->assertDontSee($project->name);

        $this->clearProjects();
    }


}
