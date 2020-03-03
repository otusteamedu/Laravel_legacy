<?php

use Illuminate\Database\Seeder;

class MtypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mtypes')->delete();
        
        \DB::table('mtypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Multilink',
                'fake' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Single link',
                'fake' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'CINT',
                'fake' => '',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'USURV',
                'fake' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'YourSurvey',
                'fake' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Federated',
                'fake' => '',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Peanuts',
                'fake' => '',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'SSI',
                'fake' => '',
            ),
            8 => 
            array (
                'id' => 99,
                'name' => 'Not defined',
                'fake' => '',
            ),
        ));
        
        
    }
}