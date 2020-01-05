<?php

use Illuminate\Database\Seeder;

class RubricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Post\Rubric::class, 5)->create();
    }
}
