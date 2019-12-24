<?php

use Illuminate\Database\Seeder;

class WorkoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            for ($i = 0; $i < 100; $i++) {
                $locationId = rand(0, 1) ? $user->locations()->inRandomOrder()->first()->id : null;
                factory(\App\Models\Workout::class, 1)->create([
                    'user_id' => $user->id,
                    'location_id' => $locationId,
                ]);
            }
        }
    }
}
