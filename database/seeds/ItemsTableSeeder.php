<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            factory(\App\Models\Item::class, 5)->create([
                'user_id' => $user->id,
                'city_id' => $user->city_id,
            ]);
        }
    }
}
