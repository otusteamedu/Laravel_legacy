<?php

use App\Models\EducationPlan;
use App\Models\Group;
use App\Models\LessonType;
use App\Models\Subject;
use App\Scopes\EducationYearScope;
use Illuminate\Database\Seeder;

class EducationPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::withoutGlobalScope(EducationYearScope::class)->get();
        $lessonTypes = LessonType::all();
        $subjects = Subject::with('teachers')->get();

        $groups->each(function (Group $group) use ($subjects, $lessonTypes): void {
            $subjects->filter(function (Subject $subject): bool {
                return rand(0, 2);
            })->each(function (Subject $subject) use ($lessonTypes, $group): void {
                $plan = factory(EducationPlan::class)->make();
                $plan->teacher()->associate($subject->teachers->random());
                $plan->subject()->associate($subject);
                $plan->lessonType()->associate($lessonTypes->random());
                $plan->group()->associate($group);
                $plan->save();
            });
        });
    }
}
