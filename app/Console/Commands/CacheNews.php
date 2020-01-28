<?php

namespace App\Console\Commands;

use App\Services\News\NewsService;
use Illuminate\Console\Command;

class CacheNews extends Command
{
    private $newsService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Cache:news{id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Работа с кешем - получение списка новостей';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewsService $newsService)
    {
        parent::__construct();
        $this->newsService = $newsService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('id');

        switch ($id) {
            case 0:
                $this->newsService->clearCacheNews();
                echo "Кеш списка новостей очишен".PHP_EOL;
                break;
            case 1:
                $this->newsService->getCachedNews();
                echo "Кеш списка новостей прогрет".PHP_EOL;
                break;
        }
    }
}
