<?php

use Illuminate\Database\Seeder;

class TaskFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\TaskFile::class, 50)->create();
    }
}
