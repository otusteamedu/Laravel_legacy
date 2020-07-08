<?php

namespace Tests\Unit\Services;

use App\DTOs\DTOInterface;
use App\DTOs\IdDTO;
use App\DTOs\StudentDTO;
use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Services\Students\StudentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class StudentServiceTest
 * @package Tests\Unit\Services
 * @group student
 */
class StudentServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var StudentService
     */
    protected $service;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var DTOInterface
     */
    protected $DTO;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(StudentService::class);

        $this->seed(\CourseSeeder::class);
        $this->seed(\EducationYearSeeder::class);
        $this->seed(\GroupSeeder::class);
        $this->seed(\RoleSeeder::class);

        $this->user = factory(User::class)->create([
            'role_id' => Role::STUDENT,
        ]);

        $this->DTO = StudentDTO::fromArray([
            StudentDTO::ID_NUMBER => rand(1, 99999999999999999),
            StudentDTO::USER_ID => $this->user->id,
        ]);
    }

    /**
     * @test
     */
    public function getTableTitles(): void
    {
        $this->assertEquals([
            __('scheduler.full_name'),
            __('scheduler.student_id'),
            __('scheduler.group'),
            __('scheduler.course'),
            ], $this->service->getTableTitles());
    }

    public function testStore(): void
    {
        $groupIdDTOs = collect([IdDTO::fromArray([
            'id' => Group::inRandomOrder()->first()->id,
        ])]);

        $this->assertDatabaseMissing('students', [
            'id_number' => $this->DTO->toArray()[StudentDTO::ID_NUMBER],
        ]);
        $this->assertInstanceOf(Student::class, $this->service->store($this->DTO, $groupIdDTOs));
        $this->assertDatabaseHas('students', [
            'id_number' => $this->DTO->toArray()[StudentDTO::ID_NUMBER],
        ]);
    }

    public function testUpdate(): void
    {
        $groupIdDTOs = collect([IdDTO::fromArray([
            'id' => Group::inRandomOrder()->first()->id,
        ])]);
        $student = factory(Student::class)->create([
            'id_number' => 0,
            'user_id' => $this->user,
        ]);

        $this->assertDatabaseMissing('students', [
            'id_number' => $this->DTO->toArray()[StudentDTO::ID_NUMBER],
        ]);
        $this->assertInstanceOf(Student::class, $this->service->update($this->DTO, $student, $groupIdDTOs));

        $this->assertDatabaseHas('students', [
            'id_number' => $this->DTO->toArray()[StudentDTO::ID_NUMBER],
        ]);
    }

    public function testDelete(): void
    {
        $student = factory(Student::class)->create([
            'id_number' => 0,
            'user_id' => $this->user,
        ]);

        $this->assertDatabaseHas('students', [
            'id_number' => $student->id_number,
        ]);
        $this->assertTrue($this->service->delete($student));
        $this->assertNull(Student::find($student->id));
    }
}
