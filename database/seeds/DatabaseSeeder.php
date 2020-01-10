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
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(RolesTableSeeder::class);

//         factory(App\Models\OperationsService::class, 100)->create();
    }
}
