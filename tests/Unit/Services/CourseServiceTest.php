<?php

namespace Tests\Unit\Services;

use App\Models\Course;
use App\Services\Courses\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CourseServiceTest
 * @package Tests\Unit\Services
 * @group course
 */
class CourseServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var CourseService
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(CourseService::class);
    }

    /**
     * @test
     */
    public function wrapCoursesByHref(): void
    {
        $course = factory(Course::class)->create();
        $collection = $this->service->wrapCoursesByHref(Course::whereIn('id', [$course->id])->get());

        $this->assertEquals([
                $course->id => "<a href=\"courses/{$course->id}\">{$course->number}</a>"
        ], $collection->toArray());
    }
}
