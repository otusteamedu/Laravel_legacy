<?php

use App\Models\Schedule;
use App\Models\ScheduleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = [
            '8:30 - 10:05',
            '10:05 - 10:15',
            '10:15 - 11:50',
            '11:50 - 12:00',
            '12:00 - 13:35',
            '13:35 - 14:20',
            '14:20 - 15:55',
            '15:55 - 16:05',
            '16:05 - 17:40',
            '17:40 - 17:50',
            '17:50 - 19:25',
            '19:25 - 19:35',
            '19:35 - 21:10',
        ];
        $rest = [
            '10:05 - 10:15',
            '11:50 - 12:00',
            '13:35 - 14:20',
            '15:55 - 16:05',
            '17:40 - 17:50',
            '19:25 - 19:35',
        ];

        $this->createSchedules(collect($lessons), ScheduleType::LESSON);
        $this->createSchedules(collect($rest), ScheduleType::REST);
    }

    /**
     * @param Collection $intervals
     * @param int $type
     */
    protected function createSchedules(Collection $intervals, int $type): void
    {
        $intervals->each(function (string $interval) use ($type): void {
            Schedule::firstOrCreate([
                'interval' => $interval,
                'schedule_type_id' => $type,
            ]);
        });
    }
}
