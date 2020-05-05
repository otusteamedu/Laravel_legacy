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
        foreach (\App\Models\Project::all() as $project) {
            factory(\App\Models\Offer::class)->create([
                'project_id' => $project->id,
                'city_id' => rand(\App\Models\City::min('id'), \App\Models\City::max('id')) ,
                'category_id' => rand(\App\Models\Category::min('id'), \App\Models\Category::max('id')),
            ]);
        }
    }
}
