<?php

use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Workout::class, 1000)
            ->make(["user_id" => 1, "complex_id" => 1])->each(function($workout) {
                $workout->user_id = rand(1,50);
                $workout->complex_id = rand(1, 100);
                return $workout->save();
            });
    }
}
