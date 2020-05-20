<?php

use Illuminate\Database\Seeder;

class ProjectTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Project::all() as $item) {
            factory(\App\Models\ProjectTask::class, rand(1,10))->create([
                'project_id'  => $item->id,
                'user_id'     => $item->users->random()->id,
            ]);
        }
    }
}
