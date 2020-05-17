<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adverts')->truncate();

        DB::table('adverts')->insert([
            'user_id' => '2',
            'town_id' => '1',
            'division_id' => '2',
            'title' => 'Toyota Land Cruiser 200',
            'price' => '3500000',
            'img' => 'xxxxxxxxx',
            'content' => 'дом расположен в отличном районе города',
        ]);

        DB::table('adverts')->insert([
            'user_id' => '2',
            'town_id' => '3',
            'division_id' => '2',
            'title' => '2-к квартира, 53 м², 14/17 эт.',
            'price' => '5500000',
            'img' => 'xxxxxxxxx',
            'content' => 'О КВАРТИРЕ: располагается на 14-ом этаже 17-ти этажного панельного дома.',
        ]);


    }
}
