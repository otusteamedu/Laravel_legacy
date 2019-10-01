<?php

use App\Models\Compilation;
use Illuminate\Database\Seeder;

class CompilationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Compilation::class, 3)->create();
    }
}
