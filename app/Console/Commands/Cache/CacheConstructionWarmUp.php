<?php


namespace App\Console\Commands\Cache;

use App\Services\Constructions\ConstructionsService;
use Illuminate\Console\Command;
use GuzzleHttp;

class CacheConstructionWarmUp extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache_construction_warm_up:command  {--only-clear : If clear cache without warm up.} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command warmUp CacheConstructions for API ';

    private $constructionsService;

    /**
     * TestCommand constructor.
     * @param ConstructionsService $constructionsService
     */
    public function __construct(
        ConstructionsService $constructionsService
    )
    {
        $this->constructionsService = $constructionsService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $onlyClear = $this->option('only-clear');
        $this->constructionsService->clearConstructionCache();

        if(!$onlyClear){
            $client = new GuzzleHttp\Client();
            $res = $client->request('GET', env('APP_UR').'/api/constructions');
            echo $res->getStatusCode();
        }

        return 0;

    }

}
