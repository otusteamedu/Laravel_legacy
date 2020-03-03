<?php

use Illuminate\Database\Seeder;

class FilterTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('filter_types')->delete();
        
        \DB::table('filter_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'age',
                'description' => 'Insert ages for Polls',
                'created' => '2015-06-16 16:27:58',
                'modified' => '2015-06-16 16:27:58',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Cities ',
                'description' => 'Cities IDs ";" - delimeter',
                'created' => '2015-06-16 16:28:37',
                'modified' => '2015-06-16 16:28:37',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Industies',
                'description' => 'Industies Рабочий',
                'created' => '2015-06-17 20:59:42',
                'modified' => '2015-06-17 20:59:42',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Country',
                'description' => 'Country IDs;',
                'created' => '2015-06-17 21:01:01',
                'modified' => '2015-06-17 21:01:01',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Exclude polls',
                'description' => 'Exlude users from polls lists',
                'created' => '2015-09-03 09:58:19',
                'modified' => '2015-09-03 09:58:19',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Include users from poll',
                'description' => 'Include users from polls Ex. include users from poll_id1;poll_id2',
                'created' => '2015-09-03 10:01:29',
                'modified' => '2015-09-03 10:01:29',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Gender ',
                'description' => 'gender. Мужской; Женский',
                'created' => '2015-09-03 10:02:56',
                'modified' => '2015-09-03 10:02:56',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Exclude users',
            'description' => 'Exclude users from survey. Delimited by semicolon (;)',
                'created' => '2015-10-25 11:36:09',
                'modified' => '2015-10-25 11:36:09',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Include users',
            'description' => 'Include users list from survey. Delimited by semicolon (;)',
                'created' => '2015-10-25 11:36:37',
                'modified' => '2015-10-25 11:36:37',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Education',
                'description' => 'Education',
                'created' => '2016-07-18 13:04:41',
                'modified' => '2016-07-18 13:04:41',
            ),
        ));
        
        
    }
}