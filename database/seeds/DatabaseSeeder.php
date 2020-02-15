<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EventTypesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
    }
}
