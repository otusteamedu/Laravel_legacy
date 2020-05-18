<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\City::all() as $city) {
            factory(\App\Models\Company::class, 5)->create([
                'city_id' => $city->id,
            ]);
        }
    }
}
