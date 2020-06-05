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

        $this->call(FilmsTableSeeder::class);

        $this->call(ActorsTableSeeder::class);
        
        $this->call(ProducersTableSeeder::class);

        $this->call(CommentsTableSeeder::class);

        $this->call(YearsTableSeeder::class);

        $this->call(GenresTableSeeder::class);

        $this->call(ActorsAndRolesTableSeeder::class);
    }
}
