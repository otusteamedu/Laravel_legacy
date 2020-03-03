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
        // $this->call(UsersTableSeeder::class);
        $this->call(FiltersTableSeeder::class);
        $this->call(FilterTypesTableSeeder::class);
        $this->call(FiltersQuotasTableSeeder::class);
        $this->call(MlinksTableSeeder::class);
        $this->call(MpollsTableSeeder::class);
        $this->call(MpollsQuotasTableSeeder::class);
        $this->call(MstatusesTableSeeder::class);
        $this->call(MtypesTableSeeder::class);
        $this->call(QuotasTableSeeder::class);
    }
}
