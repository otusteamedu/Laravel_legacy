<?php

use App\Models\Business;
use App\Models\Procedure;
use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Business::all() as $business) {
            foreach (Procedure::whereBusinessId($business->id)->get() as $procedure) {
                foreach (User::all() as $user) {
                    factory(Record::class, 1)->create([
                        'business_id' => $business->id,
                        'procedure_id' => $procedure->id,
                        'client_id' => $user->id,
                    ]);
                }
            }
        }
    }
}
