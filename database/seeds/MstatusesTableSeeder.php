<?php

use Illuminate\Database\Seeder;

class MstatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mstatuses')->delete();
        
        \DB::table('mstatuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'In progress',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Paused',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Closed',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Not defined',
            ),
        ));
        
        
    }
}