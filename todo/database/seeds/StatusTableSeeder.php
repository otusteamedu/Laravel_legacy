<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data [] = [
            'name' => 'Выполнено',

        ];
        $data [] = [
            'name' => 'Не выполнено',

        ];
        DB::table('statuses')->insert($data);
    }
}
