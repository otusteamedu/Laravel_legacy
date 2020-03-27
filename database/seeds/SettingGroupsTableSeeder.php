<?php

use Illuminate\Database\Seeder;

class SettingGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('seeds.setting_groups') as $format) {
            DB::table('setting_groups')->insert($format);
        }
    }
}
