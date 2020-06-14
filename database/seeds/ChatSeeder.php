<?php

use App\Models\Chat;
use App\Models\Student;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();

        $students->each(function (Student $student): void {
            factory(Chat::class)->create([
                'student_id' => $student->id,
            ]);
        });
    }
}
