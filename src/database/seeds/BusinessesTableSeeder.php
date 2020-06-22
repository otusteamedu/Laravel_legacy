<?php

use Illuminate\Database\Seeder;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = \App\Models\BusinessType::all();

        foreach (\App\Models\User::all() as $user) {
            $key = rand(0, count($types) - 1);

            factory(\App\Models\Business::class, 1)->create([
                'user_id' => $user->id,
                'type_id' => $types[$key]->id,
            ]);
        }
    }
}
