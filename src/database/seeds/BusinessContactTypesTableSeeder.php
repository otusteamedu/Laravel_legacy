<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessContactTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["Телефон", "WhatsApp", "Email", "Skype"];

        foreach ($types as $type) {
            factory(\App\Models\BusinessContactType::class, 1)->create([
                'name' => $type
            ]);
        }
    }
}
