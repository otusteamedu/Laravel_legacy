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
        foreach (config('seeds.categories.topics') as $category) {
            factory(App\Models\Category::class)->create($category);
        }

        foreach (config('seeds.categories.colors') as $category) {
            factory(App\Models\Category::class)->create($category);
        }

        foreach (config('seeds.categories.interiors') as $category) {
            factory(App\Models\Category::class)->create($category);
        }
    }
}
