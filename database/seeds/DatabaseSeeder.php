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
        $this->call(GroupSeeder::class);
        $this->call(UserSeeder::class);

        if (env('APP_DEBUG')) {
            $this->call(FinanceSeeder::class);
            $this->call(ProjectSeeder::class);
            $this->call(ProjectUserSeeder::class);
            $this->call(ProjectTaskSeeder::class);
            $this->call(TaskCommentSeeder::class);
            $this->call(TaskFileSeeder::class);
        }
    }
}
