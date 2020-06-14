<?php

use App\Models\Consultation;
use App\Models\Student;
use Illuminate\Database\Seeder;

class ConsultationStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();

        Consultation::approved()->get()
            ->each(function (Consultation $consultation) use ($students): void {
                 if ($consultation->limit) {
                     $consultation->students()->sync($students->shuffle()->take(rand(1, $consultation->limit)));
                 }
            });
    }
}
