<?php

use App\Models\LessonType;
use Illuminate\Database\Seeder;

class LessonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            LessonType::LECTURE => __('scheduler.lecture'),
            LessonType::PRACTICE => __('scheduler.practice'),

        ];

        foreach ($types as $id => $type) {
            LessonType::firstOrCreate([
                'id' => $id,
                'type' => $type,
            ]);
        }
    }
}
