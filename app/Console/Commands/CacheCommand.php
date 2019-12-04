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
                            {   --c|--cache-code= : Код Кэша котрый нужно очистить }
                            {   --H|--heating : Прогрев }
                            {   --a|--claear-all : Очистить весь кэш }';

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
        $cacheCode=$this->option('cache-code');
        if(!empty($cacheCode)){
            $this->cacheService->clearKey($cacheCode);
        }
        $heating=$this->option('heating');
        if(!empty($heating)){
            $this->cacheService->heating();
        }
        $claearAll=$this->option('claear-all');
        if(!empty($claearAll)){
            $this->cacheService->clear();
        }
        if((empty($claearAll))&&(empty($heating))&&(empty($claearAll))) {
            $this->info('use: php artisan list cache');
        }
    }
}
