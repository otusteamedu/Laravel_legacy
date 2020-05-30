<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'user_role';

        DB::table($tableName)->truncate();

        $usersCount = User::count();

        for ($i = 1; $i <= $usersCount; $i++) {
            DB::table($tableName)->insert([
                'id' => $i,
                'user_id' => $i,
                'role_id' => 2
            ]);
        }

        DB::table($tableName)->insert([
            'id' => $usersCount + 1,
            'user_id' => $usersCount,
            'role_id' => 1
        ]);
    }
}
