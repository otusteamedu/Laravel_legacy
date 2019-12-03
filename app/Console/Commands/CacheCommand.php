<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

//use App\Services\Cache;

class CacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache 
                            {   cacheCode? : Код Кэша котрый нужно очистить }
                            {   --H|--heating : Прогрев }
                            {   --a|--claearAll : Очистить весь кэш }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $cacheService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $b=false;
        $cacheCode=$this->argument('cacheCode');
        if(!empty($cacheCode)){
            $this->cacheService->clearKey($cacheCode);
            $b=true;
        }
        $heating=$this->option('heating');
        if(!empty($heating)){
            $this->cacheService->heating();
            $b=true;
        }
        $claearAll=$this->option('claearAll');
        if(!empty($claearAll)){
            $this->cacheService->clear();
            $b=true;
        }
        if(!$b) {
            $this->info('use: php artisan list cache');
        }
    }
}
