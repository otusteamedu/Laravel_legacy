<?php

use App\Models\User;
use App\Models\Country;
use \App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 50; $i++) {
            factory(\App\Models\Event::class, 1)->create([
                'author_id' => User::all()->random()->id,
                'country_id' => Country::all()->random()->id,
                'type_id' => EventType::all()->random()->id,
            ]);
        }
    }
}
