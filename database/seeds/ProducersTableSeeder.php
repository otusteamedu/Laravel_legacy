<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actors')->insert(
            array(
                array('id' => '1','name' => 'Альфонсо Куарон', 'slug'=>'', 'image'=> 'img/alfonso.png'),
                array('id' => '2','name' => 'Адам Козенс', 'slug'=>'', 'image'=> 'img/cozens.png'),
                array('id' => '3','name' => 'Орто Игнатиуссен', 'slug'=>'', 'image'=> 'img/ignatiyssen.png')
            )
        );
    }
}
