<?php

use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\City::all() as $city) {
            foreach (\App\Models\Project::all() as $project) {
                factory(\App\Models\Offer::class, 50)->create([
                    'project_id' => $project->id,
                    'city_id' => $city->id,
                ]);
            }
        }
    }
}
