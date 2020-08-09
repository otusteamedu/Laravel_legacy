<?php

use Illuminate\Database\Seeder;

class BusinessAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Business::all() as $business) {
            factory(\App\Models\BusinessAddress::class, 2)->create([
                'business_id' => $business->id,
            ]);
        }
    }
}
