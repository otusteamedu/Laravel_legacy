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

        $arStudentUser=array();
        $arUserID = User::get()->pluck('id')->toArray();
        $arStudentID = Student::get()->pluck('id')->toArray();

        foreach ($arStudentID as $sID) {
            $arStudentUser[] = ['student_id' => $sID, 'user_id' => array_random($arUserID)];
        }

        DB::table('student_user')->insert($arStudentUser);
    }
}
