<?php

use Illuminate\Database\Seeder;

class MlinksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mlinks')->delete();
        
        \DB::table('mlinks')->insert(array (
            0 => 
            array (
                'id' => 5843369,
                'mpoll_id' => 0,
                'link' => NULL,
                'user_id' => NULL,
                'status' => 0,
                'user_ip' => NULL,
                'created' => '2019-09-29 15:00:02',
                'modified' => '2019-09-29 15:00:02',
            ),
            1 => 
            array (
                'id' => 5843370,
                'mpoll_id' => 0,
                'link' => NULL,
                'user_id' => NULL,
                'status' => 0,
                'user_ip' => NULL,
                'created' => '2019-09-29 16:51:29',
                'modified' => '2019-09-29 16:51:29',
            ),
            2 => 
            array (
                'id' => 5843371,
                'mpoll_id' => 80,
                'link' => 'http://link.luxsurveys.com/daliaoffers/rpoll/[SUB]',
                'user_id' => NULL,
                'status' => 0,
                'user_ip' => NULL,
                'created' => '2019-10-15 23:48:52',
                'modified' => '2019-11-20 02:22:49',
            ),
            3 => 
            array (
                'id' => 5843372,
                'mpoll_id' => 80,
                'link' => 'http://link.luxsurveys.com/daliaoffers/rpoll/ls_6kRrh6Ojnp-42w',
                'user_id' => 55,
                'status' => 1,
                'user_ip' => '80.232.243.220',
                'created' => '2019-10-25 17:21:41',
                'modified' => '2019-10-25 17:21:41',
            ),
            4 => 
            array (
                'id' => 5843373,
                'mpoll_id' => 80,
                'link' => 'http://link.luxsurveys.com/daliaoffers/rpoll/ls_6kRrh6Ojnp-42w',
                'user_id' => 55,
                'status' => 1,
                'user_ip' => '80.232.243.220',
                'created' => '2019-10-25 17:37:28',
                'modified' => '2019-10-25 17:37:28',
            ),
            5 => 
            array (
                'id' => 5843374,
                'mpoll_id' => 80,
                'link' => 'http://link.luxsurveys.com/daliaoffers/rpoll/ls_6kRrh6Ojnp-42w',
                'user_id' => 55,
                'status' => 1,
                'user_ip' => '80.232.243.220',
                'created' => '2019-10-25 17:38:39',
                'modified' => '2019-10-25 17:38:39',
            ),
            6 => 
            array (
                'id' => 5843375,
                'mpoll_id' => 81,
                'link' => 'http://trk.thinkaction.com/?a=70010018&c=60&s1=[SUB]',
                'user_id' => NULL,
                'status' => 0,
                'user_ip' => NULL,
                'created' => '2019-10-25 21:47:17',
                'modified' => '2019-12-04 20:23:20',
            ),
            7 => 
            array (
                'id' => 5843376,
                'mpoll_id' => 1,
                'link' => 'http://www.your-surveys.com/?si=488&ssi=ls_6kRrh6rvnta4&email=ruslangr%40yahoo.com&gender=m&first_name=Ruslangr&last_name=GR&zip_code=13301&unique_user_id=ls_ls_6kRrh_fgnp-42w&hmac=59c758d167367b6357c073f7d9b2d13e',
                'user_id' => 55,
                'status' => 1,
                'user_ip' => '80.232.243.220',
                'created' => '2019-11-07 16:32:32',
                'modified' => '2019-11-07 16:32:32',
            ),
            8 => 
            array (
                'id' => 5843377,
                'mpoll_id' => 1,
                'link' => 'http://www.your-surveys.com/?si=488&ssi=ls_6kRrh6rvntS7&email=amber.coughtrey%40submissiontechnology.co.uk&gender=f&first_name=Amber+&last_name=Coughtrey&zip_code=ME20+6EQ&unique_user_id=ls_ls_6kRrh_fgnp-62A&hmac=fd33077c57cf9f3a3c8a07ee42fea40b',
                'user_id' => 76,
                'status' => 1,
                'user_ip' => '37.235.122.254',
                'created' => '2019-11-12 08:43:06',
                'modified' => '2019-11-12 08:43:06',
            ),
            9 => 
            array (
                'id' => 5843378,
                'mpoll_id' => 1,
                'link' => 'http://www.your-surveys.com/?si=488&ssi=ls_6kRrh6rvntu5&email=jeffdan48%40hotmail.com&gender=f&first_name=Susan&last_name=Daniels&zip_code=M25+0GZ&unique_user_id=ls_ls_6kRrh_fgnp-12g&hmac=00b2d55bc35eef8ea75963b49c2d7019',
                'user_id' => 84,
                'status' => 1,
                'user_ip' => '82.28.197.137',
                'created' => '2019-11-19 08:56:04',
                'modified' => '2019-11-19 08:56:04',
            ),
        ));
        
        
    }
}