<?php

use App\Models\Picture;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
        for($i = 1; $i < 50; $i++) {
            factory(User::class, 1)->create(
                [
                    'country_id' => Country::all()->random()->id,
                    'picture_id' => Picture::all()->random()->id,
                ]
            );
        }
    }
}
