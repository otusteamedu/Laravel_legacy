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
        $this->call([
            CategoriesTableSeeder::class,
            CountriesTableSeeder::class,
            CitiesTableSeeder::class,
            RolesTableSeeder::class,
            TypesTableSeeder::class,
            UsersTableSeeder::class,
            PostsTableSeeder::class,
        ]);
    }
}
