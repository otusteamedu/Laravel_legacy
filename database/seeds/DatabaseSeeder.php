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
        $this->call(UserSeeder::class);
        $this->call(EquipmentSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(ComplexSeeder::class);
        $this->call(WorkoutSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
