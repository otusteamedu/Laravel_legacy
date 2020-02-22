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
        // Real data
        $this->call(EventTypesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        // Fake data
        $this->call(PictureTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(EventUserTableSeeder::class);
        $this->call(EventPictureTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
    }
}
