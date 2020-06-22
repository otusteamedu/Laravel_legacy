<?php

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::times(10, function (int $course): Course {
            return Course::firstOrCreate([
                'number' => $course,
            ]);
        });
    }
}
