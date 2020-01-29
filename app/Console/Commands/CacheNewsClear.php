<?php

namespace App\Console\Commands;

use App\Services\News\NewsService;
use Illuminate\Console\Command;

class CacheNewsClear extends Command
{
    private $newsService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Очистке кеша';

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
        $this->newsService->clearCacheNews();
    }
}
