<?php

namespace Tests\Unit\Services;

use App\DTOs\DTOInterface;
use App\DTOs\GroupDTO;
use App\Models\Course;
use App\Models\EducationYear;
use App\Models\Group;
use App\Services\Groups\GroupService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CourseServiceTest
 * @package Tests\Unit\Services
 * @group group
 */
class GroupServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var GroupService
     */
    protected $service;

    /**
     * @var DTOInterface
     */
    protected $DTO;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(GroupService::class);

        $this->seed(\CourseSeeder::class);
        $this->seed(\EducationYearSeeder::class);
        $this->seed(\GroupSeeder::class);

        $this->DTO = GroupDTO::fromArray([
            GroupDTO::NUMBER => rand(),
            GroupDTO::COURSE_ID => Course::inRandomOrder()->first()->id,
            GroupDTO::EDUCATION_YEAR_ID => EducationYear::inRandomOrder()->first()->id,
        ]);
    }

    /**
     * @test
     */
    public function getTableTitles(): void
    {
        $this->assertEquals(
            [__('scheduler.group'), __('scheduler.course')],
            $this->service->getTableTitles()
        );
    }

    public function testStore(): void
    {
        $this->assertDatabaseMissing('groups', [
            'number' => $this->DTO->toArray()[GroupDTO::NUMBER],
        ]);
        $this->assertInstanceOf(Group::class, $this->service->store($this->DTO));
        $this->assertDatabaseHas('groups', [
            'number' => $this->DTO->toArray()[GroupDTO::NUMBER],
        ]);
    }

    public function testUpdate(): void
    {
        $group = Group::inRandomOrder()->first();

        $this->assertDatabaseMissing('groups', [
            'number' => $this->DTO->toArray()[GroupDTO::NUMBER],
        ]);
        $this->assertInstanceOf(Group::class, $this->service->update($this->DTO, $group));
        $this->assertDatabaseHas('groups', [
            'number' => $this->DTO->toArray()[GroupDTO::NUMBER],
        ]);
    }

    public function testDelete(): void
    {
        $group = Group::inRandomOrder()->first();

        $this->assertDatabaseHas('groups', [
            'number' => $group->number,
        ]);
        $this->assertTrue($this->service->delete($group));
        $this->assertNull(Group::find($group->id));
    }

    /**
     * @test
     */
    public function getCoursesFromGroupCollection(): void
    {
        $groups = Group::take(2)->get();
        $this->service->getCoursesFromGroupCollection($groups)
            ->each(function ($item) {
                $this->assertInstanceOf(Course::class, $item);
            });
    }

    /**
     * @test
     */
    public function wrapGroupsByHref(): void
    {
        $groups = Group::take(1)->get();

        $group = $groups->first();
        $this->assertEquals(
            [$group->id => '<a href="' . route('groups.show', $group->id) . '">' . $group->number . '</a>'],
            $this->service->wrapGroupsByHref($groups)->toArray()
        );
    }
}
