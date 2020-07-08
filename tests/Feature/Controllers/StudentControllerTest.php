<?php

namespace Tests\Feature\Controllers;

use App\Models\Course;
use App\Models\EducationYear;
use App\Models\Group;
use App\Models\Student;
use App\Models\Role;
use App\Models\User;
use App\Services\Students\StudentService;
use App\Services\Users\UserService;
use Faker\Factory;
use Tests\TestCase;

/**
 * Class StudentControllerTest
 * @package Tests\Feature\Controllers
 * @group student
 */
class StudentControllerTest extends TestCase
{
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
     * GET /dashboard/students
     */
    public function testIndex(): void
    {
        $this->actingAs($this->user)
            ->get(route('students.index'))
            ->assertOk()
            ->assertViewHasAll([
                'students',
                'titles',
                'filter',
                'groupService',
                'courseService',
                'courseList',
                'groupList',
            ]);
    }

    /**
     * GET /dashboard/students/create
     */
    public function testCreate(): void
    {
        $this->actingAs($this->user)
            ->get(route('students.create'))
            ->assertOk()
            ->assertViewHasAll([
                'courseList',
                'groupList',
            ]);
    }

    /**
     * POST /dashboard/students
     */
    public function testStore(): void
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        $body = [
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'group_id' => [$group = factory(Group::class)->create([
                'course_id' => factory(Course::class)->create(),
                'education_year_id' => EducationYear::inRandomOrder()->first()->id,
            ])->id],
            'id_number' => rand(1,99999999999999999),
        ];

        $user = factory(User::class)->create([
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'role_id' => Role::STUDENT,
        ]);
        $student = factory(Student::class)->create([
            'user_id' => $user->id,
        ]);

        $this->partialMock(UserService::class, function ($mock) use ($user) {
            $mock->shouldReceive('store')->once()
                ->andReturn($user);
        });
        $this->partialMock(StudentService::class, function ($mock) use ($student) {
            $mock->shouldReceive('store')->once()
            ->andReturn($student);
        });

        $this->actingAs($this->user)
            ->post(route('students.store'), $body)
            ->assertRedirect(route('students.show', $student))
            ->assertSessionHas('success');
    }

    /**
     * GET /dashboard/students/{student}
     */
    public function testShow(): void
    {
        $student = factory(Student::class)->create([
            'user_id' => factory(User::class)->create([
                'role_id' => Role::STUDENT,
            ]),
        ]);

        $this->actingAs($this->user)
            ->get(route('students.show', $student))
            ->assertOk()
            ->assertViewHasAll(['student']);
    }

    /**
     * GET /dashboard/students/{student}/edit
     */
    public function testEdit(): void
    {
        $student = factory(Student::class)->create([
            'user_id' => factory(User::class)->create([
                'role_id' => Role::STUDENT,
            ]),
        ]);

        $this->actingAs($this->user)
            ->get(route('students.edit', $student))
            ->assertOk()
            ->assertViewHasAll([
                'student',
                'courseList',
                'groupList',
                'studentGroupsId',
            ]);
    }

    /**
     * PUT /dashboard/students/{student}
     */
    public function testUpdate(): void
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        $body = [
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'group_id' => [$group = factory(Group::class)->create([
                'course_id' => factory(Course::class)->create(),
                'education_year_id' => EducationYear::inRandomOrder()->first()->id,
            ])->id],
            'id_number' => rand(1,99999999999999999),
        ];

        $user = factory(User::class)->create([
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'role_id' => Role::STUDENT,
        ]);
        $student = factory(Student::class)->create([
            'user_id' => $user->id,
            'id_number' => $body['id_number'],
        ]);

        $this->partialMock(UserService::class, function ($mock) use ($user) {
            $mock->shouldReceive('update')->once()
                ->andReturn($user);
        });
        $this->partialMock(StudentService::class, function ($mock) use ($student) {
            $mock->shouldReceive('update')->once()
                ->andReturn($student);
        });

        $this->actingAs($this->user)
            ->put(route('students.update', $student), $body)
            ->assertRedirect(route('students.show', $student))
            ->assertSessionHas('success');
    }

    /**
     * DELETE /dashboard/students/{student}
     */
    public function testDestroy(): void
    {
        $student = factory(Student::class)->create([
            'user_id' => factory(User::class)->create([
                'role_id' => Role::STUDENT,
            ]),
        ]);

        $this->partialMock(UserService::class, function ($mock) {
            $mock->shouldReceive('delete')->once()
                ->andReturn(true);
        });
        $this->partialMock(StudentService::class, function ($mock) {
            $mock->shouldReceive('delete')->once()
                ->andReturn(true);
        });

        $this->actingAs($this->user)
            ->delete(route('students.destroy', $student))
            ->assertRedirect(route('students.index'))
            ->assertSessionHas('success');
    }
}
