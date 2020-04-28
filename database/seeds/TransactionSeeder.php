<?php

use Illuminate\Database\Seeder;

use App\Models\User as User;
use App\Models\Student as Student;
use App\Models\Reason as Reason;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arTransaction=array();
        $arUserID = User::get()->pluck('id')->toArray();
        $arStudentID = Student::get()->pluck('id')->toArray();
        $arReasonID = Reason::get()->toArray();

        for ($i = 0; $i < 40; $i++) {

            $tmpReason = array_random($arReasonID);

            $arTransaction[] = [
                'student_id' => array_random($arStudentID),
                'user_id' => array_random($arUserID),
                'reason_id' => $tmpReason['id'],
                'amount' => $tmpReason['amount']
            ];
        }

        DB::table('transactions')->insert($arTransaction);
    }
}
