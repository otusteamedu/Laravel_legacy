<?php

namespace Tests\Unit\Services;

use App\DTOs\IdDTO;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use App\Services\Teachers\TeacherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class TeacherServiceTest
 * @package Tests\Unit\Services
 * @group teacher
 */
class TeacherServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var TeacherService
     */
    protected $service;
    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(TeacherService::class);

        $this->seed(\SubjectSeeder::class);
        $this->seed(\RoleSeeder::class);

        $this->user = factory(User::class)->create([
            'role_id' => Role::TEACHER,
        ]);
    }

    /**
     * @test
     */
    public function getTableTitles(): void
    {
        $this->assertEquals([
            __('users.full_name'),
            __('scheduler.email'),
            __('scheduler.subjects'),
            __('scheduler.teaching_load'),
            ], $this->service->getTableTitles());
    }

    /**
     * @test
     */
    public function syncWithSubjects(): void
    {
        $subjects = Subject::take(2)->get();
        $subjectsDTOs = $subjects->map(function (Subject $subject): IdDTO {
            return IdDTO::fromArray(['id' => $subject->id]);
        });

        $this->assertEquals(
            $subjects->pluck('id')->toArray(),
            $this->service->syncWithSubjects($this->user, $subjectsDTOs)
                ->subjects->pluck('id')->toArray()
        );
    }
}
