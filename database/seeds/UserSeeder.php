<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::all()->each(function (Role $role) {
            factory(User::class, 10)->create([
                'role_id' => $role->id,
            ]);
        });

        factory(User::class, 200)->create([
            'role_id' => Role::STUDENT,
        ]);

        factory(User::class, 1)->create([
            'email' => 'meth@meth.ru',
            'role_id' => Role::METHODIST,
        ]);

        factory(User::class, 1)->create([
            'email' => 'admin@admin.ru',
            'role_id' => Role::ADMIN,
        ]);

        $teacherForTest = User::byRole(Role::TEACHER)->inRandomOrder()->first();
        $teacherForTest->update(['email' => 'teach@teach.ru']);

        $studentForTest = User::byRole(Role::STUDENT)->inRandomOrder()->first();
        $studentForTest->update(['email' => 'st@st.ru']);
    }
}
