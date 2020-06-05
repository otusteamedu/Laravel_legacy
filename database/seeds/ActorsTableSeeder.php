<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Film::all() as $film) {
            factory(\App\Models\Actor::class, 5)->create([
                'film_id' => $film->id,
            ]);
        }
    }
}
