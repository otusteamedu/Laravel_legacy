<?php

use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::byRole(Role::TEACHER)->get();

        factory(Subject::class, 30)->create()
        ->each(function (Subject $subject) use ($teachers): void {
            /**
             * Назначить от 1 до 2х преподавателей
             */
            $subject->teachers()->syncWithoutDetaching($teachers->shuffle()->take(rand(1, 2))->modelKeys());
        });
    }
}
