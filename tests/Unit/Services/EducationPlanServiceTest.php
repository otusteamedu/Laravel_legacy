<?php

namespace Tests\Unit\Services;

use App\Models\Course;
use App\Models\EducationPlan;
use App\Models\Group;
use App\Models\LessonType;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use App\Services\EducationPlans\EducationPlanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CourseServiceTest
 * @package Tests\Unit\Services
 * @group education_plan
 */
class EducationPlanServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var EducationPlanService
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(EducationPlanService::class);

        $this->seed(\CourseSeeder::class);
        $this->seed(\RoleSeeder::class);
        $this->seed(\EducationYearSeeder::class);
        $this->seed(\GroupSeeder::class);
        $this->seed(\LessonTypeSeeder::class);
        $this->seed(\SubjectSeeder::class);
        factory(User::class, 2)->create([
            'role_id' => Role::TEACHER,
        ]);
    }

    /**
     * @test
     */
    public function getHoursForEducationPlans(): void
    {
        $plans = factory(EducationPlan::class, 2)->make()
            ->each(function (EducationPlan $plan): void {
            $plan->hours = rand();
            $plan->subject_id = Subject::inRandomOrder()->first()->id;
            $plan->group_id = Group::inRandomOrder()->first()->id;
            $plan->user_id = User::inRandomOrder()->first()->id;
            $plan->lesson_type_id = LessonType::inRandomOrder()->first()->id;
            $plan->save();
        });

        $this->assertEquals($plans->sum('hours'), $this->service->getHoursForEducationPlans($plans));
    }
}
