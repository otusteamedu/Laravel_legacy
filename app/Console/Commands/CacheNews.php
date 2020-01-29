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
    protected $signature = 'news:cache {time?} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Кеширование новостей';

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
        $time = $this->argument('time');
        $id = $this->option('id');

        if (!empty($time) && empty($id)) {
            $this->newsService->getCachedNews($time);
        }

        if (!empty($id) && empty($time)) {
            $this->newsService->getCachedId($id);
        }


    }
}
