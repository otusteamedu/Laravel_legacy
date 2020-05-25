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

        $status = factory(\App\Models\Status::class)->create();
        factory(\App\Models\Task::class, 20)->create(['status_id' => $status->id]);

        $this->call(StudioSeeder::class);
       // $this->call(TestSeeder::class);
    }
}
