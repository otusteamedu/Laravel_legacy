<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Symfony\Component\Console\Tests\Command\createClosure;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminEmail = "vit_ermakov@mail.ru";
        $rawPassword = "vit_ermakov";
        $rootRole = Role::where(['code' => 'root'])->first();
        $registeredRole = Role::where(['code' => 'registered'])->first();

        if($rootRole) {
            $superAdmin = [
                'name' => "Администратор",
                'email' => $adminEmail,
                'email_verified_at' => now(),
                'password' => Hash::make($rawPassword),
                'remember_token' => Str::random(10)
            ];

            $user = User::create($superAdmin);
            $user->roles()->attach($rootRole->id);

            $user->save();
        }

        if($registeredRole) {
            factory(\App\Models\User::class, 10)->create()->each(
                function (User $user) use ($registeredRole) {
                    $user->roles()->attach($registeredRole->id);
                }
            );
        }
    }
}
