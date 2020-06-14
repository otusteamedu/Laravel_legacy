<?php

use App\Models\ScheduleType;
use Illuminate\Database\Seeder;

class ScheduleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ScheduleType::LESSON => __('scheduler.lesson_time'),
            ScheduleType::REST => __('scheduler.rest'),
        ];

        foreach ($types as $id => $type) {
            ScheduleType::firstOrCreate([
                'id' => $id,
                'type' => $type,
            ]);
        }
    }
}
