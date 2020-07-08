<?php

namespace Tests\Feature\Controllers;

use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use App\Services\Teachers\TeacherService;
use App\Services\Users\UserService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class TeacherControllerTest
 * @package Tests\Feature\Controllers
 * @group teacher
 */
class TeacherControllerTest extends TestCase
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

        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);
    }

    /**
     * GET /dashboard/teachers
     */
    public function testIndex(): void
    {
        $this->actingAs($this->user)
            ->get(route('teachers.index'))
            ->assertOk()
            ->assertViewHasAll([
                'teachers',
                'titles',
                'subjectService',
                'educationPlanService',
                'subjects',
                'filter',
            ]);
    }

    /**
     * GET /dashboard/teachers/create
     */
    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('teachers.create'))
            ->assertOk()
            ->assertViewHasAll([
                'subjects',
            ]);
    }

    /**
     * POST /dashboard/teachers
     */
    public function testStore(): void
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        $body = [
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'subject_id' => [factory(Subject::class)->create()->id],
            'email' => $faker->email,
        ];

        $teacher = $user = factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);

        $this->partialMock(UserService::class, function ($mock) use ($user) {
            $mock->shouldReceive('store')->once()
                ->andReturn($user);
        });
        $this->partialMock(TeacherService::class, function ($mock) use ($teacher) {
            $mock->shouldReceive('syncWithSubjects')->once()
            ->andReturn($teacher);
        });

        $this->actingAs($this->user)
            ->post(route('teachers.store'), $body)
            ->assertRedirect(route('teachers.show', $teacher))
            ->assertSessionHas('success');
    }

    /**
     * GET /dashboard/teachers/{teacher}
     */
    public function testShow(): void
    {
        $teacher = factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);

        $this->actingAs($this->user)
            ->get(route('teachers.show', $teacher))
            ->assertOk()
            ->assertViewHasAll([
                'teacher',
                'educationPlanService'
            ]);
    }

    /**
     * GET /dashboard/teachers/{teacher}/edit
     */
    public function testEdit(): void
    {
        $teacher = factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);

        $this->actingAs($this->user)
            ->get(route('teachers.edit', $teacher))
            ->assertOk()
            ->assertViewHasAll([
                'teacher',
                'subjects',
                'teacherSubjectsId',
            ]);
    }

    /**
     * PUT /dashboard/teachers/{teacher}
     */
    public function testUpdate(): void
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        $body = [
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'subject_id' => [factory(Subject::class)->create()->id],
            'email' => $faker->email,
        ];

        $teacher = $user = factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);

        $this->partialMock(UserService::class, function ($mock) use ($user) {
            $mock->shouldReceive('update')->once()
                ->andReturn($user);
        });
        $this->partialMock(TeacherService::class, function ($mock) use ($teacher) {
            $mock->shouldReceive('syncWithSubjects')->once()
                ->andReturn($teacher);
        });

        $this->actingAs($this->user)
            ->put(route('teachers.update', $teacher), $body)
            ->assertRedirect(route('teachers.show', $teacher))
            ->assertSessionHas('success');
    }

    /**
     * DELETE /dashboard/teachers/{teacher}
     */
    public function testDestroy(): void
    {
        $teacher = factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);

        $this->partialMock(UserService::class, function ($mock) {
            $mock->shouldReceive('delete')->once()
                ->andReturn(true);
        });

        $this->actingAs($this->user)
            ->delete(route('teachers.destroy', $teacher))
            ->assertRedirect(route('teachers.index'))
            ->assertSessionHas('success');
    }
}
