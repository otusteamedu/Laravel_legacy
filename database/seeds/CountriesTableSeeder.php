<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [
                'name' => 'Россия',
                'phone_code' => '+7'
            ],
            [
                'name' => 'Україна',
                'phone_code' => '+38'
            ]
        ]);
    }
}
