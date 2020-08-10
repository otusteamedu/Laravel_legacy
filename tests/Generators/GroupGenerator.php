<?php

namespace Tests\Generators;

use App\Models\Course;
use App\Models\EducationYear;
use App\Models\Group;

class GroupGenerator
{
    /**
     * @param $data
     * @return Group
     */
    public static function generateGroup(array $data): Group
    {
        return factory(Group::class)->create([
            'course_id' => factory(Course::class)->create(),
            'education_year_id' => $data['education_year_id'] ?? EducationYear::inRandomOrder()->first()->id,
        ]);
    }
}
