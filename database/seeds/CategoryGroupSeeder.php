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

        factory(CategoryGroup::class, rand(5, 15))->create();
    }
}
