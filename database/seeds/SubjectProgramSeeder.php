<?php

use App\Models\LessonType;
use App\Models\Subject;
use App\Models\SubjectProgram;
use Illuminate\Database\Seeder;

class SubjectProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::with('teachers')->get();
        $lessonTypes = LessonType::all();

        $subjects->each(function (Subject $subject) use ($lessonTypes): void {
            $program = factory(SubjectProgram::class)->make();
            $program->subject()->associate($subject);
            $program->teacher()->associate($subject->teachers->random());
            $program->lessonType()->associate($lessonTypes->random());
            $program->save();
        });
    }
}
