<?php

use Illuminate\Database\Seeder;

class ResponsibilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(\App\Models\Group::all() as $group){
            factory(\App\Models\Responsibility::class, 10)->create([
                'group_id'=>$group->id,
            ]);
        }
    }
}
