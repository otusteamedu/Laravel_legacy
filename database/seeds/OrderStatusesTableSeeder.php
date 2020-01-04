<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('seeds.order_statuses') as $status) {
            DB::table('order_statuses')->insert($status);
        }
    }
}
