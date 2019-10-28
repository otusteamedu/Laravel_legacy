<?php

use App\Models\User;
use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            factory(Widget::class, 1)->create([
                'created_user_id' => $user->id
            ]);
        }
    }
}
