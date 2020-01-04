<?php

use App\Models\Category;
use Faker\Generator as FakerGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(FakerGenerator $faker)
    {
        $categorySeedsData = config('seed.categories');

        foreach ($categorySeedsData as $item) {
            factory(Category::class)->make([
                'parent_id' => $item['parent_id'],
                'slug' => Str::slug($item['title']),
                'title' => $item['title'],
                'description' => $item['description'],
            ])->save();
        }
    }
}
