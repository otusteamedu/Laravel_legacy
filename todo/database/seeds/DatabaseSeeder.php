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
        $this->call(UserTableSeeder::class);
        //$this->call(StatusTableSeeder::class);
        $status = factory(\App\Models\Status::class)->create();
        factory(\App\Models\Task::class, 20)->create(['status_id' => $status->id]);
    }
}
