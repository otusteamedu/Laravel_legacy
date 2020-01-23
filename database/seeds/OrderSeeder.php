<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Products;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            /**
             * @property $orders App\Models\Order
             */
            $orders = factory(Order::class, rand(1, 3))
                ->create([
                    'user_id' => $user->id,
                    'delivery_id' => $this->getDeliveryRandomId(),
                ])
                ->each(function ($order) {
                    $order->order()->attach($order->id);
                    //TODO как передать связь к продукту ?
                });
        }
    }

    private function getDeliveryRandomId(): int
    {
        return DB::table('deliveries')->inRandomOrder()->select('id')->first()->id;
    }

    private function getProductRandomId(): int
    {
        return DB::table('products')->inRandomOrder()->select('id')->first()->id;
    }
}
