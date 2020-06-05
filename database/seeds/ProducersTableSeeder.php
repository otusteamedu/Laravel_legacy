<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Film::all() as $film) {
            factory(\App\Models\Producer::class, 5)->create([
                'film_id' => $film->id,
            ]);
        }
    }
}
