<?php

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ComplexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Complex::class, 100)
            ->create()
            ->each(function ($complex) {
                $number_of_exercises = rand(1, 10);
                for ($i = 0; $i < $number_of_exercises; $i++) {
                    $exercise_id = rand(1, 50);
                    $reps = rand(1, 30);
                    $complex->exercise()->attach(Exercise::find($exercise_id), ["reps" => $reps]);
                }
            });
    }
}
