<?php

use Illuminate\Database\Seeder;

class MpollQuotaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('mpoll_quota')->delete();

        \DB::table('mpoll_quota')->insert(array (
            0 =>
            array (
                'id' => 37,
                'mpoll_id' => NULL,
                'quota_id' => NULL,
                'mstatus_id' => 0,
                'completes' => 0,
                'sent' => 0,
                'send_posible' => 0,
                'sending' => 0,
            'order' => 'RAND()',
                'clicks' => 0,
                'prescreener' => NULL,
                'overquota' => 0,
                'screenout' => 0,
                'created_at' => '2019-09-29 16:46:52',
                'updated_at' => '2019-09-29 16:46:52',
                'complete' => 0,
            ),
            1 =>
            array (
                'id' => 38,
                'mpoll_id' => NULL,
                'quota_id' => NULL,
                'mstatus_id' => 0,
                'completes' => 0,
                'sent' => 0,
                'send_posible' => 0,
                'sending' => 0,
            'order' => 'RAND()',
                'clicks' => 0,
                'prescreener' => NULL,
                'overquota' => 0,
                'screenout' => 0,
                'created_at' => '2019-10-15 23:48:52',
                'updated_at' => '2019-10-15 23:48:52',
                'complete' => 0,
            ),
            2 =>
            array (
                'id' => 39,
                'mpoll_id' => NULL,
                'quota_id' => NULL,
                'mstatus_id' => 0,
                'completes' => 0,
                'sent' => 0,
                'send_posible' => 0,
                'sending' => 0,
            'order' => 'RAND()',
                'clicks' => 0,
                'prescreener' => NULL,
                'overquota' => 0,
                'screenout' => 0,
                'created_at' => '2019-10-25 21:47:17',
                'updated_at' => '2019-10-25 21:47:17',
                'complete' => 0,
            ),
        ));


    }
}
