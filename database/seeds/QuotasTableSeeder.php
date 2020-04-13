<?php

use Illuminate\Database\Seeder;

class QuotasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('quotas')->delete();
        DB::table('quotas')->insert(array(
            0 =>
                array(
                    'country_id' => 21,
                    'mpoll_id' => 1,
                    'name' => 'Age1',
                    'description' => 'Age1',
                    'completes' => 0,
                    'over_quotas' => 0,
                    'screenout' => 0,
                ),
            1 =>
                array(
                    'country_id' => 21,
                    'mpoll_id' => 1,
                    'name' => 'Age2',
                    'description' => 'Age2',
                    'completes' => 0,
                    'over_quotas' => 0,
                    'screenout' => 0,
                ),
            2 =>
                array(
                    'country_id' => 21,
                    'mpoll_id' => 1,
                    'name' => 'Age3',
                    'description' => 'Age3',
                    'completes' => 0,
                    'over_quotas' => 0,
                    'screenout' => 0,
                ),


        ));


    }
}
