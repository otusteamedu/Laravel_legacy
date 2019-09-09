<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     *
     */
    public function run()
    {
        DB::table('roles')->insert([

            'description' => str_random(10),
            'context' => str_random(20),
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
