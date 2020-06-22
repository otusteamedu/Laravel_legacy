<?php

use App\Models\Course;
use App\Models\EducationYear;
use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        $years = EducationYear::all();

        factory(Group::class, 30)->make()
            ->each(function (Group $group) use ($courses, $years): void {
                $group->course()->associate($courses->random());
                $group->year()->associate($years->random());
                $group->save();
            });
    }
}
