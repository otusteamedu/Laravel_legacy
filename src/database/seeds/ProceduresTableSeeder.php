<?php

use Illuminate\Database\Seeder;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            $business = \App\Models\Business::whereUserId($user->id)->first();

            factory(\App\Models\Procedure::class, 3)->create([
                'business_id' => $business->id,
                'worker_id' => $user->id,
            ]);
        }
    }
}
