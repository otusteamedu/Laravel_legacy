<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'text' => 'Отличный сервис',
            'user_id' => 1,
            'active' => 1
        ]);
    }
}
