<?php

namespace App\Console\Commands;

use App\Services\Countries\CountriesService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command {id*} {--f|--flag} {--size=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $countriesService;

    /**
     * Create a new command instance.
     *
     * @param CountriesService $countriesService
     */
    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ids = $this->options();

        echo 'Countries: ', $this->countriesService->searchCountries()->count();
    }
}
