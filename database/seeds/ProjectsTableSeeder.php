<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            factory(\App\Models\Project::class, 10)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
