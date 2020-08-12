<?php

use Illuminate\Database\Seeder;

class BusinessContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\BusinessAddress::all() as $business_address) {
            foreach (\App\Models\BusinessContactType::all() as $type) {
                factory(\App\Models\BusinessContact::class, 1)->create([
                    'business_address_id' => $business_address->id,
                    'type_id' => $type->id,
                ]);
            }
        }
    }
}
