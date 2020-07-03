<?php

use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Scopes\EducationYearScope;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::byRole(Role::STUDENT)->get();
        $groups = Group::withoutGlobalScope(EducationYearScope::class)->get();

        $users->each(function (User $user) use ($groups): void {
            $student = factory(Student::class)->make();
            $student->user()->associate($user);
            $student->save();
            $student->groups()->sync($groups->shuffle()->take(rand(1, 2)));
        });
    }
}
