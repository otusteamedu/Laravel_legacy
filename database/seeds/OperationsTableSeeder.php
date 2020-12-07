<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operations')->insert([
            //сегодня
            ['sum' => 3000, 'category_id' => 7, 'description' => 'Ашан', 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['sum' => 500, 'category_id' => 16, 'description' => 'Мойка автомобиля', 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['sum' => 30000, 'category_id' => 1, 'description' => '', 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //вчера
            ['sum' => 1000, 'category_id' => 9, 'description' => 'Джинсы', 'user_id' => 1, 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],
            ['sum' => 1800, 'category_id' => 11, 'description' => 'Кафе', 'user_id' => 1, 'created_at' => Carbon::now()->subDay(), 'updated_at' => Carbon::now()->subDay()],

            //3 дня назад (неделя)
            ['sum' => 200, 'category_id' => 11, 'description' => 'Парикмахерская', 'user_id' => 1, 'created_at' => Carbon::now()->subDay(3), 'updated_at' => Carbon::now()->subDay(3)],
            ['sum' => 800, 'category_id' => 13, 'description' => 'Простуда', 'user_id' => 1, 'created_at' => Carbon::now()->subDay(3), 'updated_at' => Carbon::now()->subDay(3)],

            //2 недели назад (месяц)
            ['sum' => 3500, 'category_id' => 16, 'description' => 'Замена моторного масла', 'user_id' => 1, 'created_at' => Carbon::now()->subWeek(2), 'updated_at' => Carbon::now()->subWeek(2)],
            ['sum' => 4100, 'category_id' => 8, 'description' => '', 'user_id' => 1, 'created_at' => Carbon::now()->subWeek(2), 'updated_at' => Carbon::now()->subWeek(2)],

            //2 месяца назад (квартал)
            ['sum' => 150, 'category_id' => 17, 'description' => '', 'user_id' => 1, 'created_at' => Carbon::now()->subMonth(2), 'updated_at' => Carbon::now()->subMonth(2)],
            ['sum' => 400, 'category_id' => 15, 'description' => 'Кино', 'user_id' => 1, 'created_at' => Carbon::now()->subMonth(2), 'updated_at' => Carbon::now()->subMonth(2)],

            //6 месяцев назад(год)
            ['sum' => 2500, 'category_id' => 10, 'description' => 'Логопед', 'user_id' => 1, 'created_at' => Carbon::now()->subMonth(6), 'updated_at' => Carbon::now()->subMonth(6)],
            ['sum' => 660, 'category_id' => 14, 'description' => 'Магнит "Косметик"', 'user_id' => 1, 'created_at' => Carbon::now()->subMonth(6), 'updated_at' => Carbon::now()->subMonth(6)],
        ]);
    }
}
