<?php

namespace Tests\Feature\Controllers;

use App\Models\Course;
use App\Models\EducationYear;
use App\Models\User;
use App\Services\Groups\GroupService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\Generators\GroupGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class GroupControllerTest
 * @package Tests\Feature\Controllers
 * @group group
 */
class GroupControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\RoleSeeder::class);
        $this->seed(\EducationYearSeeder::class);

        $this->user = UserGenerator::generateMethodist();
    }

    /**
     * GET /dashboard/groups
     */
    public function testIndex(): void
    {
        $this->actingAs($this->user)
            ->get(route('groups.index'))
            ->assertOk()
            ->assertViewHasAll([
                'groups',
                'titles',
                'filter',
            ]);
    }

    /**
     * GET /dashboard/groups/create
     */
    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('groups.create'))
            ->assertOk()
            ->assertViewHasAll([
                'courses',
                'years',
            ]);
    }

    /**
     * POST /dashboard/groups
     */
    public function testStore(): void
    {
        $body = [
            'number' => rand(1, 99999),
            'course_id' => factory(Course::class)->create()->id,
            'education_year_id' => EducationYear::inRandomOrder()->first()->id,
        ];
        $group = GroupGenerator::generateGroup(['education_year_id' => $body['education_year_id']]);

        $this->mock(GroupService::class, function ($mock) use ($group) {
            $mock->shouldReceive('store')->once()
                ->andReturn($group);
        });

        $this->actingAs($this->user)
            ->post(route('groups.store'), $body)
            ->assertRedirect(route('groups.show', $group))
            ->assertSessionHas('success');

        $this->actingAs($this->user)
            ->post(route('groups.store'), [])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');

        $notValidBody = [
            'number' => 'test',
            'course_id' => 'test',
            'education_year_id' => 'test',
        ];
        $this->actingAs($this->user)
            ->post(route('groups.store'), $notValidBody)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');
    }

    /**
     * GET /dashboard/groups/{group}
     */
    public function testShow(): void
    {
        $group = GroupGenerator::generateGroup(['education_year_id' => EducationYear::inRandomOrder()->first()->id]);

        $this->actingAs($this->user)
            ->get(route('groups.show', $group))
            ->assertOk()
            ->assertViewHasAll(['group']);
    }

    /**
     * GET /dashboard/groups/{group}/edit
     */
    public function testEdit(): void
    {
        $group = GroupGenerator::generateGroup(['education_year_id' => EducationYear::inRandomOrder()->first()->id]);

        $this->actingAs($this->user)
            ->get(route('groups.edit', $group))
            ->assertOk()
            ->assertViewHasAll([
                'courses',
                'years',
            ]);
    }

    /**
     * PUT /dashboard/groups/{group}
     */
    public function testUpdate(): void
    {
        $body = [
            'number' => rand(1, 99999),
            'course_id' => factory(Course::class)->create()->id,
            'education_year_id' => EducationYear::inRandomOrder()->first()->id,
        ];
        $group = GroupGenerator::generateGroup(['education_year_id' => $body['education_year_id']]);

        $this->mock(GroupService::class, function ($mock) use ($group) {
            $mock->shouldReceive('update')->twice()
                ->andReturn($group);
        });

        $this->actingAs($this->user)
            ->put(route('groups.update', $group), $body)
            ->assertRedirect(route('groups.show', $group))
            ->assertSessionHas('success');

        $this->actingAs($this->user)
            ->put(route('groups.update', $group), [])
            ->assertRedirect(route('groups.show', $group))
            ->assertSessionHas('success');

        $notValidBody = [
            'number' => 'test',
            'course_id' => 'test',
            'education_year_id' => 'test',
        ];
        $this->actingAs($this->user)
            ->put(route('groups.update', $group), $notValidBody)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');
    }

    /**
     * DELETE /dashboard/groups/{group}
     */
    public function testDestroy(): void
    {
        $group = GroupGenerator::generateGroup(['education_year_id' => EducationYear::inRandomOrder()->first()->id]);

        $this->mock(GroupService::class, function ($mock) use ($group) {
            $mock->shouldReceive('delete')->once()
                ->andReturn(true);
        });

        $this->actingAs($this->user)
            ->delete(route('groups.destroy', $group))
            ->assertRedirect(route('groups.index'))
            ->assertSessionHas('success');

        $this->actingAs($this->user)
            ->delete(route('groups.destroy', rand()))
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
