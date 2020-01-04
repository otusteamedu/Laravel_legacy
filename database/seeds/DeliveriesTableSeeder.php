<?php

use Illuminate\Database\Seeder;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('seeds.deliveries') as $delivery) {
            DB::table('deliveries')->insert($delivery);
        }
    }
}
