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
        $type = \App\Models\BusinessContactType::whereName("Телефон")->first();

        foreach (\App\Models\Business::all() as $business) {
            factory(\App\Models\BusinessContact::class, 1)->create([
                'business_id' => $business->id,
                'type_id' => $type->id,
            ]);
        }
    }
}
