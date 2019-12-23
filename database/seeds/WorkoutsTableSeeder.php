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
            factory(\App\Models\Workout::class, 100)->create([
                'user_id' => $user->id,
                'location_id' => $user->locations()->inRandomOrder()->first()->id,
            ]);
        }
    }
}
