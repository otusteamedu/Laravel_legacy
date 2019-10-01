<?php

use App\Models\Journal;
use Illuminate\Database\Seeder;

class JournalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Journal::class, 3)->create();
    }
}
