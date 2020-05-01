<?php

use Illuminate\Database\Seeder;
use App\Models\User as User;
use App\Models\Student as Student;

class StudentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arStudentUser = array();
        $arUserID = User::get()->pluck('id')->toArray();
        $arStudentID = Student::get()->pluck('id')->toArray();

        foreach ($arStudentID as $sID) {
            $userID = array_random($arUserID);
            $arStudentUser[] = ['student_id' => $sID, 'user_id' => $userID];

            DB::update('update students set created_by = ? where id = ?',[$userID,$sID]);
//            Student::where('id', $sID)->updated(array('created_by' => $userID));
        }

        DB::table('student_user')->insert($arStudentUser);
    }
}
