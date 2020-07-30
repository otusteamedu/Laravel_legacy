<?php

namespace App\Console\Commands\Cities;

use App\Models\City;
use App\Models\Company;
use Illuminate\Console\Command;

class UpdateActiveCompaniesCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:active-companies-count {city?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (City::get() as $city) {
            $city->update([
                'active_companies' =>
                    Company::where('status', Company::STATUS_ACTIVE)
                        ->where('city_id', $city->id)
                        ->count(),
            ]);
        }
    }
}
