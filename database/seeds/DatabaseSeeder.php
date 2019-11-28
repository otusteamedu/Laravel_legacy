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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(ModAccessTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(TariffTableSeeder::class);
        $this->call(CinemasTableSeeder::class);
        $this->call(MovieShowingsTableSeeder::class);
        $this->call(ShowingPricesTableSeeder::class);
    }
}
