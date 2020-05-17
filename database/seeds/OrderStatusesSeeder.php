<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->truncate();

        DB::table('order_statuses')->insert([
            'id' => 1,
            'name' => 'В обработке',
            'position' => 100,
        ]);

        DB::table('order_statuses')->insert([
            'id' => 2,
            'name' => 'Собирается',
            'position' => 200,
        ]);

        DB::table('order_statuses')->insert([
            'id' => 3,
            'name' => 'Ожидает отправки',
            'position' => 300,
        ]);

        DB::table('order_statuses')->insert([
            'id' => 4,
            'name' => 'В пути',
            'position' => 400,
        ]);

        DB::table('order_statuses')->insert([
            'id' => 5,
            'name' => 'Доставлен',
            'position' => 500,
        ]);
    }
}
