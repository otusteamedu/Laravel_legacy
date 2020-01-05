<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class, 5)->create();
        factory(App\Models\Category::class, 5)->create([
            'type' => 'colors'
        ]);
        factory(App\Models\Category::class, 5)->create([
            'type' => 'interiors'
        ]);
    }
}
