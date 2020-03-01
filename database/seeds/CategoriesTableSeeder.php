<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Красота',
            'Здоровье',
            'Рестораны',
            'Развлечения',
            'Авто',
            'Фитнес',
            'Концерты',
            'Дети',
            'Разное',
        ];

        foreach ($categories as $category)
            DB::table('categories')->insert([
                'name' => $category,
                'description' => Str::random(100),
                'created_at' => now(),
            ]);
    }
}
