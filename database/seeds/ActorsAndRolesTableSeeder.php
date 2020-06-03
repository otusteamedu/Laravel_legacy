<?php

use Illuminate\Database\Seeder;

class ActorsAndRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('actors_and_roles')->insert(
            [
                'role' => "Иван Иванович",
                'film_id' => 1,
                'actor_id' => 1,
                'created_at'=>'2020-03-11 19:05:22',
                'updated_at'=>'2020-03-12 19:05:22'
            ]
        );


        DB::table('actors_and_roles')->insert(
            [
                'role' => "Иван Петрович",
                'film_id' => 2,
                'actor_id' => 2,
                'created_at'=>'2020-03-11 19:05:22',
                'updated_at'=>'2020-03-12 19:05:22'
            ]
        );
    }
}
