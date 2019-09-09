<?php

use Illuminate\Database\Seeder;

class LanguageRepositoryTableSeeder extends Seeder
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
        DB::table('language_repositories')->insert([

            'language_name' => str_random(10),
            'function_id' => random_int(1,20),
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
