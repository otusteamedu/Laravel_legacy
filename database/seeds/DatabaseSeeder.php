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
         $this->call(CountriesTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(TariffsTableSeeder::class);
         $this->call(SegmentsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ProjectsTableSeeder::class);
         $this->call(OffersTableSeeder::class);
    }
}
