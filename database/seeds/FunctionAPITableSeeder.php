<?php

use Illuminate\Database\Seeder;

class FunctionAPITableSeeder extends Seeder
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
        DB::table('function_api')->insert([

            'name' => str_random(10),
            'function' =>  str_random(10),
            'description' => null,
            'role_available' => random_int(1,6),
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
