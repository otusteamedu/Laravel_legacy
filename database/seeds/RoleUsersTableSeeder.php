<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     *
     */
    public function run()
    {

        factory(\App\Model\RoleUser::class, 15)->create();
//        DB::table('role_users')->insert([
//
//            'user_id' => random_int(1,1000),
//            'role_id' => random_int(1,1000),
//            'created_at' => now(),
//            'updated_at' => now(),
//
//        ]);
    }
}
