<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $insert=[
            [
                'name'=> 'admin',
                'email' =>'ruslan231984@yandex.ru',
                'password' => '$2y$10$EXMaRzdNsCYM7auJKbh.UepwFesnRgEd2KtqFHysU3Y08VzIq2fFS',
                'created_at' => '2019-11-23 06:15:36',
                'updated_at'=>'2019-11-23 06:15:36'
            ],

            [
                'name'=> 'guest',
                'email' =>'ruslan@yandex.ru',
                'password' => '$2y$10$EXMaRzdNsCYM7auJKbh.UepwFesnRgEd2KtqFHysU3Y08VzIq2fFS',
                'created_at' => '2019-11-23 06:15:36',
                'updated_at'=>'2019-11-23 06:15:36'
            ]
        ];
        DB::table('users')->insert($insert);

    }
}
