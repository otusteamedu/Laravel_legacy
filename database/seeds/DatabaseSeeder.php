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
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(OrgBranchesTableSeeder::class);
        $this->call(OrgTypesTableSeeder::class);
        $this->call(OrgGroupsTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
