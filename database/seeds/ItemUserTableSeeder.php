<?php

use Illuminate\Database\Seeder;

class ItemUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Item::all() as $item) {
            factory(\App\Models\ItemUser::class, 5)->create([
                'user_id' => \App\Models\User::inRandomOrder()->get()->first()->id,
                'item_id' => $item->id,
            ]);
        }
    }
}
