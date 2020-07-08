<?php

namespace Tests\Unit\Services;

use App\DTOs\DTOInterface;
use App\DTOs\GroupDTO;
use App\Models\Course;
use App\Models\EducationYear;
use App\Models\Group;
use App\Models\Subject;
use App\Services\Groups\GroupService;
use App\Services\Subjects\SubjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class SubjectServiceTest
 * @package Tests\Unit\Services
 * @group subject
 */
class SubjectServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var SubjectService
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(SubjectService::class);
    }

    /**
     * @test
     */
    public function wrapGroupsByHref(): void
    {
        $subject = factory(Subject::class)->create();

        $this->assertEquals(
            [$subject->id => '<a href="' . '/dashboard/subjects/' . $subject->id . '">' . $subject->name . '</a>'],
            $this->service->wrapGroupsByHref(collect([$subject]))->toArray()
        );
    }
}
