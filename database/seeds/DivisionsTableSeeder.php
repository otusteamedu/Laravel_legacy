<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->truncate();

        DB::table('divisions')->insert([
            'name' => 'Авто',
        ]);
        DB::table('divisions')->insert([
            'name' => 'Недвижимость',
        ]);
        DB::table('divisions')->insert([
            'name' => 'Работа',
        ]);
        DB::table('divisions')->insert([
            'name' => 'Услуги',
        ]);

    }
}
