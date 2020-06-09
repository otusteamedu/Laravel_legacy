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

    use RefreshDatabase, WithFaker;

    /**
     * Тест просмотра списка проектов
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->actingAs($this->getUser())->get('/projects');
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

        (new GroupSeeder())->run();
        $users = factory(User::class, 1)->create([
            'group_id' => Group::STAFF_ADMIN,
        ]);

        $user = $users->first();

        return $user;
    }

    /**
     * Тест просмотра страницы создания проекта
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->getUser())->get('/projects/create');
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

        $response = $this->actingAs($this->getUser())->post('/projects', ['name' => $name]);
        $response->assertStatus(302);

        $response = $this->actingAs($this->getUser())->get('/projects');
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

        $response = $this->actingAs($this->getUser())->get('/projects/' . $this->faker->numberBetween(100, 1000));
        $response->assertStatus(404);

        $response = $this->actingAs($this->getUser())->get('/projects/' . $projectId);
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

        $response = $this->actingAs($this->getUser())->get('/projects/' . $this->faker->numberBetween(100, 1000). '/edit');
        $response->assertStatus(404);

        $response = $this->actingAs($this->getUser())->get('/projects/' . $projectId . '/edit');
        $response->assertStatus(200);

    }

    /**
     * Тест обновления проекта
     *
     * @return void
     */
    public function testUpdate()
    {
        $name = $this->faker->name;
        $projectId = $this->getProject()->id;

        $response = $this->actingAs($this->getUser())->patch('/projects/' . $this->faker->numberBetween(100, 1000), ['name' => $name]);
        $response->assertStatus(404);

        $response = $this->actingAs($this->getUser())->patch('/projects/' . $projectId, ['name' => $name]);
        $response->assertStatus(302);

        $response = $this->actingAs($this->getUser())->get('/projects');
        $response->assertSeeText($name);
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

        $response = $this->actingAs($this->getUser())->get('/projects');
        $response->assertSee($project->name);

        $response = $this->actingAs($this->getUser())->delete('/projects/' . $this->faker->numberBetween(100, 1000));
        $response->assertStatus(404);

        $response = $this->actingAs($this->getUser())->delete('/projects/' . $projectId);
        $response->assertStatus(302);

        $response = $this->actingAs($this->getUser())->get('/projects');
        $response->assertDontSee($project->name);
    }


}
