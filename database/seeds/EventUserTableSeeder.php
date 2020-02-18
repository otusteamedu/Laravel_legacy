<?php

use Illuminate\Database\Seeder;
use App\Models\EventUser;

class EventUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EventUser::class, 100)->create();
    }
}
