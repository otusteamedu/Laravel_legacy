<?php

use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        unset($data);
        $data [] = [
            'style_id' => '1',
            'name' => 'Aerial silks',


        ];
        $data [] = [
            'style_id' => '2',
            'name' => 'Pole Sport',

        ];
        DB::table('styles')->insert($data);

        //prices
        unset($data);
        $data [] = [
            'id' => '1',
            'description' => 'Абонемент 8 занятий',
            'price' => '10000',
        ];
        $data [] = [
            'id' => '2',
            'description' => 'Абонемент 12 занятий',
            'price' => '15000',


        ];
        DB::table('prices')->insert($data);

        //instructors
        unset($data);
        $data [] = [
            'instructor_id' => '1',
            'name' => 'Саша Ли',
            'description' => 'Описание ',
            'link' => 'instructors/1',
        ];
        $data [] = [
            'instructor_id' => '2',
            'name' => 'Катя Иванова',
            'description' => 'Описание ',
            'link' => 'instructors/2',


        ];
        DB::table('instructors')->insert($data);

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
