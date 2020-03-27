<?php

use App\Models\User;
use App\Models\Country;
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
        // @ToDo: узнать, это баг или норма? Если создавать 50 пользователей через один генератор,
        // то число из random() всегда одно и то же
        for ($i = 1; $i < 50; $i++) {
            factory(\App\Models\Event::class, 1)->create([
                'author_id' => User::all()->random()->id,
                'country_id' => Country::all()->random()->id,
            ]);
        }
    }
}
