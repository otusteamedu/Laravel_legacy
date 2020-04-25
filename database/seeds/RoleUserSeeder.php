<?php


use Illuminate\Database\Seeder;
use App\Models\User as User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arRoleUser = array();
        $arUserID = User::get()->pluck('id')->toArray();

        foreach ($arUserID as $uID) {
            if ($uID == 1) {
                $arRoleUser[] = array('role_id' => '1', 'user_id' => '1');
            } elseif ($uID == 2) {
                $arRoleUser[] = array('role_id' => '3', 'user_id' => '2');
            } else {
                $arRoleUser[] = array('role_id' => '2', 'user_id' => $uID);
            }

        }

        DB::table('role_user')->insert($arRoleUser);
    }
}
