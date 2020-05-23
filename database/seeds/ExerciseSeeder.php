<?php

use App\Models\Equipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Exercise::class, 50)
            ->create([
                "user_id" => rand(1, 15)
            ])
            ->each(function ($exercise) {
//            Adding random equipment to some exercises
                $case = rand(1, 10);
                if ($case > 3) {
                    $equip = rand(1, 40);
                    $exercise->equipment()->attach(Equipment::find($equip));
                }
            });


    }
}
