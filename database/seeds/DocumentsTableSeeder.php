<?php

use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Price::all() as $contract) {
            $data = [
                'contract_id' => $contract->id,
                'date' => $contract->created_at
            ];
            factory(\App\Models\Document::class)->create($data);
        }

    }
}
