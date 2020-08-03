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
         $this->call(UserRolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(BusinessTypesTableSeeder::class);
         $this->call(BusinessesTableSeeder::class);
         $this->call(BusinessContactTypesTableSeeder::class);
         $this->call(BusinessAddressesTableSeeder::class);
         $this->call(BusinessContactTableSeeder::class);
         $this->call(ProceduresTableSeeder::class);
    }
}
