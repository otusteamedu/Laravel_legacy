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
         $this->call(RolesTableSeed::class);
         $this->call(UsersTableSeeder::class);
         $this->call(CategoriesTableSeed::class);
         $this->call(CommentsTableSeed::class);
    }
}
