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
        $this->call(RoomsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);

        $this->call(ContractsTableSeeder::class);
        $this->call(PricesTableSeeder::class);

        //$this->call(DocumentsTableSeeder::class);
    }
}
