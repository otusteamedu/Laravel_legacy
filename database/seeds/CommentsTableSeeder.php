<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Film::all() as $film) {
            factory(\App\Models\Comment::class, 2)->create([
                'film_id' => $film->id,
            ]);
        }
    }
}
