<?php

namespace Tests\Feature\Controllers;

use App\Models\EducationYear;
use App\Models\Student;
use App\Models\Role;
use App\Models\User;
use App\Services\Students\StudentService;
use App\Services\Users\UserService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Traits\Generator;

/**
 * Class StudentControllerTest
 * @package Tests\Feature\Controllers
 * @group student
 */
class StudentControllerTest extends TestCase
{
    use Generator;
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

        $this->user = $this->generateMethodist();
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
            'group_id' => [$this->generateGroup([
                'education_year_id' => EducationYear::inRandomOrder()->first()->id,
            ])->id],
            'id_number' => rand(1, 99999999999999999),
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

        $this->actingAs($this->user)
            ->post(route('students.store'), [])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');

        $notValidBody = [
            'last_name' => [],
            'name' => [],
            'second_name' => [],
            'group_id' => 'test',
            'id_number' => 'test',
        ];
        $this->actingAs($this->user)
            ->post(route('students.store'), $notValidBody)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');
    }

    /**
     * GET /dashboard/students/{student}
     */
    public function testShow(): void
    {
        $student = $this->generateStudent();

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
        $student = $this->generateStudent();

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
            'group_id' => [$this->generateGroup([
                'education_year_id' => EducationYear::inRandomOrder()->first()->id,
            ])->id],
            'id_number' => rand(1, 99999999999999999),
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

        $this->actingAs($this->user)
            ->put(route('students.update', $student), [])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');

        $notValidBody = [
            'last_name' => [],
            'name' => [],
            'second_name' => [],
            'group_id' => 'test',
            'id_number' => 'test',
        ];
        $this->actingAs($this->user)
            ->put(route('students.update', $student), $notValidBody)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');

        /**
         * ID number already exist
         */
        $newStudent = factory(Student::class)->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($this->user)
            ->put(route('students.update', $newStudent), $body)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('errors');
    }

    /**
     * DELETE /dashboard/students/{student}
     */
    public function testDestroy(): void
    {
        $student = $this->generateStudent();

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

        $this->actingAs($this->user)
            ->delete(route('students.destroy', rand()))
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
