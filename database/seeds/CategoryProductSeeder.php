<?php

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends RelationSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_product')->truncate();

        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $relationsCount = rand(1200, $categoriesCount * $productsCount / 2);

        $relationsArray = $this->getRelationsArray(
            $relationsCount, $categoriesCount, $productsCount
        );

        for ($i = 1; $i <= $productsCount; $i++) {
            $isRelationForThisProductExist = false;
            for ($j = 1; $j <= $relationsCount; $j++) {
                if ($relationsArray[$j][1] == $i) {
                    $isRelationForThisProductExist = true;
                    break;
                }
            }
            if (!$isRelationForThisProductExist) {
                $relationsArray[] = [rand(1, $categoriesCount), $i];
            }
        }

        $this->saveRelations(
            $relationsArray, 'category_product', 'category_id', 'product_id'
        );
    }
}
