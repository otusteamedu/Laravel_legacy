<?php

use Illuminate\Database\Seeder;
use \App\Models\Town;
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

        factory(Town::class, 5)->create();

    }
}
