<?php

namespace Tests\Feature;

use App\Models\Project;
use Tests\Generators\ProjectGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
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
        $response = $this->actingAs(UserGenerator::generateAdmin())->get(route('projects.index'));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы создания проекта
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs(UserGenerator::generateAdmin())->get(route('projects.create'));
        $response->assertStatus(200);
    }

    /**
     * Тест создания проекта
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->post(route('projects.store'), $data);
        $response->assertStatus(302);

        $response = $this->get(route('projects.index'));
        $response->assertSeeText($data['name']);
    }

    /**
     * Тест создания проекта в БД
     *
     * @return void
     */
    public function testStoreInDb()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->post(route('projects.store'), $data);
        $response->assertStatus(302);

        $this->assertDatabaseHas(Project::getTableName(), $data);
    }

    /**
     * Тест просмотра страницы проекта
     *
     * @return void
     */
    public function testShow()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $project = ProjectGenerator::generateProject();

        $response = $this->get(route('projects.show', ['project' => $project->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы не существуещего проекта
     *
     * @return void
     */
    public function testShow404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('projects.show', ['project' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

    /**
     * Тест просмотра страницы редактирования проекта
     *
     * @return void
     */
    public function testEdit()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $project = ProjectGenerator::generateProject();

        $response = $this->get(route('projects.edit', ['project' => $project->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы редактирования не существующего проекта
     *
     * @return void
     */
    public function testEdit404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('projects.edit', ['project' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

    /**
     * Тест обновления проекта
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $project = ProjectGenerator::generateProject();

        $response = $this->put(route('projects.update', ['project' => $project->id]), $data);
        $response->assertStatus(302);

        $response = $this->get(route('projects.index'));
        $response->assertSeeText($data['name']);
    }

    /**
     * Тест обновления проекта в БД
     *
     * @return void
     */
    public function testUpdateInDb()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $project = ProjectGenerator::generateProject();

        $response = $this->put(route('projects.update', ['project' => $project->id]), $data);
        $response->assertStatus(302);

        $this->assertDatabaseHas(Project::getTableName(), $data);
    }

    /**
     * Тест обновления не существующего проекта
     *
     * @return void
     */
    public function testUpdate404()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->put(route('projects.update', ['project' => $this->faker->numberBetween(100, 1000)]), $data);
        $response->assertStatus(404);
    }

    /**
     * Тест удаления проекта
     *
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $project = ProjectGenerator::generateProject();

        $response = $this->get(route('projects.index'));
        $response->assertSee($project->name);

        $response = $this->delete(route('projects.destroy', ['project' => $project->id]));
        $response->assertStatus(302);

        $response = $this->get(route('projects.index'));
        $response->assertDontSee($project->name);
    }

    /**
     * Тест удаления проекта в БД
     *
     * @return void
     */
    public function testDeleteInDb()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $project = ProjectGenerator::generateProject();

        $this->assertDatabaseHas(Project::getTableName(), ['id' => $project->id]);

        $response = $this->delete(route('projects.destroy', ['project' => $project->id]));
        $response->assertStatus(302);

        $this->assertSoftDeleted(Project::getTableName(), ['id' => $project->id]);
    }

    /**
     * Тест удаления не существующего проекта
     *
     * @return void
     */
    public function testDelete404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->delete(route('projects.destroy', ['project' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

}
