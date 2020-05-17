<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TownsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('towns')->truncate();

        DB::table('towns')->insert([
            'name' => 'Москва',
        ]);

        DB::table('towns')->insert([
            'name' => 'Рязань',
        ]);

        DB::table('towns')->insert([
            'name' => 'Подольск',
        ]);
    }
}
