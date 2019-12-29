<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Role;

class RolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesSeedsData = config('seed.roles');

        foreach ($rolesSeedsData as $item) {
            factory(Role::class)->make([
                'title' => $item['title'],
                'description' => $item['description'],
            ])->save();
        }
    }
}
