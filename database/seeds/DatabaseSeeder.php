<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(EducationYearSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(LessonTypeSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(SubjectProgramSeeder::class);
        $this->call(EducationPlanSeeder::class);
        $this->call(ScheduleTypeSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(RoomOcupationSeeder::class);
        $this->call(ConsultationStudentSeeder::class);
    }
}
