<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            ['name' => 'buy'],
            ['name' => 'sell']
        ]);
    }
}
