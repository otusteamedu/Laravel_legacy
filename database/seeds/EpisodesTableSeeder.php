<?php

use App\Models\Episode;
use Illuminate\Database\Seeder;

class EpisodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Episode::class, 150)->create();
    }
}
