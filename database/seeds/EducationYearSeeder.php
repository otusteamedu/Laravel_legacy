<?php

use App\Models\EducationYear;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class EducationYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::times(5, function (int $years): EducationYear {
            return EducationYear::firstOrCreate([
                'start_at' => Carbon::now()->addYears(2)->subYears($years)->addDay()->format('Y-m-d'),
                'end_at' => Carbon::now()->addYears(3)->subYears($years)->format('Y-m-d'),
            ]);
        });
    }
}
