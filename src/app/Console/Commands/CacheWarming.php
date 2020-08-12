<?php

namespace App\Console\Commands;

use App\Models\Business;
use App\Services\Businesses\BusinessService;
use Illuminate\Console\Command;

class CacheWarming extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warming';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Прогрев кэша';

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
    public function handle(BusinessService $businessService)
    {
        $businesses = Business::all();
        $bar = $this->output->createProgressBar(count($businesses));
        $bar->start();

        foreach ($businesses as $business) {
            $businessService->get($business->id);
            $bar->advance();
        }

        $bar->finish();
        $this->line("");
        $this->info("Кэш успешно прогрет");
    }
}
