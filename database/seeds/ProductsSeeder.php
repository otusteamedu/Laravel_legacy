<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\CategoryProduct::all() as $category) {
            factory(\App\Models\Products::class, rand(3,8))->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
