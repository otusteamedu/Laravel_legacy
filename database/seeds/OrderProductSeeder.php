<?php

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;

class OrderProductSeeder extends RelationSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'order_product';

        DB::table($tableName)->truncate();

        $ordersCount = Order::count();
        $productsCount = Product::count();
        $relationsCount = rand(100, 1000);

        $relationsArray = $this->getRelationsArray(
            $relationsCount, $ordersCount, $productsCount, true
        );

        $this->saveRelations(
            $relationsArray, $tableName, 'order_id', 'product_id'
        );
    }


}
