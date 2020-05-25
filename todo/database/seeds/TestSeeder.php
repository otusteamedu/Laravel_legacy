<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //schedules
        unset($data);
        $data [] = [
            'id' => '1',
            'instructor_id' => '1',
            'style_id' => '1',
            'days' => 'Пн-ср-пт',
            'time' => '20:00-21:00'

        ];
        $data [] = [
            'id' => '2',
            'instructor_id' => '2',
            'style_id' => '2',
            'days' => 'Пн-ср-пт',
            'time' => '20:00-21:00'


        ];
        $data [] = [
            'id' => '3',
            'instructor_id' => '1',
            'style_id' => '1',
            'days' => 'Вт-чт-сб',
            'time' => '20:00-21:00'

        ];
        $data [] = [
            'id' => '4',
            'instructor_id' => '2',
            'style_id' => '2',
            'days' => 'Вт-чт-сб',
            'time' => '20:00-21:00'


        ];
        DB::table('schedules')->insert($data);
    }
}
