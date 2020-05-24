<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryGroup;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_groups')->truncate();
        DB::table('category_groups_ru')->truncate();

        factory(CategoryGroup::class, rand(5, 15))->create();

        $categoryGroups = CategoryGroup::all();
        foreach ($categoryGroups as $group) {
            $group->nameRu($group->name . 'Ru');
        }
    }
}
