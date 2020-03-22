<?php

namespace App\Console\Commands\Cache;

use App\Services\Cache\Repositories\CacheRepositoryInterface;
use Illuminate\Console\Command;

class Warmup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warmup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Прогрев кэша. Заполнит кэш данными всех пользователей.';

    /**
     * @var CacheRepositoryInterface
     */
    private $cacheRepository;

    /**
     * Create a new command instance.
     *
     * @param CacheRepositoryInterface $cacheRepository
     */
    public function __construct(CacheRepositoryInterface $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cacheRepository->warmupUserCache();// наполни кэш данными
        echo "Вызван разогрев кэша.".PHP_EOL;
    }
}
