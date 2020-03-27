<?php

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Database\Seeder;

class EventUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 50; $i++) {
            factory(EventUser::class, 1)->create([
                'user_id' => User::all()->random()->id,
                'event_id' => Event::all()->random()->id,
            ]);
        }
    }
}
