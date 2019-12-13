<?php

use App\Models\Project;
use App\Models\User;
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
        $project = Project::create([
            'git' => 'https://github.com/phptrack/phptrack.io',
        ]);

        $adminUser = User::where(['email' => 'admin@example.com'])->first();
        $project->users()->attach($adminUser);
    }
}
