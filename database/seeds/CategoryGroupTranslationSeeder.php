<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryGroup;
use App\Models\CategoryGroupTranslation;

class CategoryGroupTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_group_translations')->truncate();

        $categoryGroups = CategoryGroup::all();

        foreach ($categoryGroups as $categoryGroup) {
            $categoryGroupTranslation = new CategoryGroupTranslation();
            $categoryGroupTranslation->category_group_id = $categoryGroup->id;
            $categoryGroupTranslation->attribute = 'name';
            $categoryGroupTranslation->value = $categoryGroup->name . 'Ru';
            $categoryGroupTranslation->save();
        }
    }
}