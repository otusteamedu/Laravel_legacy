<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            factory(\App\Models\Location::class, 3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
