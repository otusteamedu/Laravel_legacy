<?php

namespace App\Console\Commands\Cms\Films;

use Illuminate\Console\Command;
//use App\Services\Cache\Handlers\WarmupCacheHandler;

/**
 * Консольная команда публикует все фильмы
 * неопубликованные
 * Class AllPublicFilms
 * @package App\Console\Commands
 */
class AllPublicFilms extends Command
{
    /**
     * The name and signature of the console command.
     * в дальнейшем кеш расширю для остальных моделей
     *
     * @var string
     */
    protected $signature = 'film:public
        {--all : Public All Films}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Public Films';


    private $allPublicFilmsHandler;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WarmupCacheHandler $warmupCacheHandler)
    {
        $this->warmupCacheHandler = $warmupCacheHandler;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $options = $this->option();
        if (!empty($options['films'])) {
            $ts = microtime(true);
            $this->warmupCacheHandler->warmUpForFilms();
            $time = microtime(true) - $ts;
            $this->info('Films cache clear: ' . $time . 's');
        }
        if (empty($options['cms']) && empty($options['films'])) {
            $this->info("Nothing to do!");
        }
    }
}
