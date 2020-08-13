<?php

namespace App\Console\Commands\Cms\Films;

use Illuminate\Console\Command;

use App\Services\Films\Handlers\AllPublicFilmHandler;

/**
 * Консольная команда публикует все фильмы которые находяться в статусе - неопубликованные
 * очищает кеш при изменении каждого фильма
 * Class AllPublicFilms
 * @package App\Console\Commands
 */
class AllPublicFilms extends Command
{
    /**
     * --all - команда публикует все не опубликованные ранее фильмы
     * --id = 1,2,3 - команда публикует указанные фильмы (через запятую указываются id фильмов)
     * @var string
     */
    protected $signature = 'cms:films:public
        {--all : Public All Films}
        {--id=None : Public specified Film (id=1,2,3)}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Public Films';

    /** @var AllPublicFilmHandler */
    private $allPublicFilmsHandler;
    /** @var CachedFilmRepositoryInterface */
    private $cachedFilmRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AllPublicFilmHandler $allPublicFilmsHandler)
    {
        $this->allPublicFilmsHandler = $allPublicFilmsHandler;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->option();
        
        if (!empty($options['all'])) {
            $result = $this->allPublicFilmsHandler->publicAll(); 
            $this->templateResult($result);
        }
        if(!empty($options['id']) && $options['id']!='None' ){
           $arIds = explode( ',', $options['id'] );
           $result = $this->allPublicFilmsHandler->publicByIds($arIds); 
           $this->templateResult($result);
        }

  
    }

    public function templateResult($result){

        if (!empty($result)){
            $ts = microtime(true);
            $bar = $this->output->createProgressBar(count($result));
            $headers = ['ID','TITLE', 'SLUG', 'STATUS'];
            //пошаговое выполнение
            foreach ($result as $item) {
                sleep(1);
                $bar->advance();
            };
            $bar->finish();
            $time = microtime(true) - $ts;
            //выводим результат выполнения
            $this->table($headers, $result);
            $this->info('Films public: ' . $time . 's');
        }
        else{
            $this->info("Nothing to do!"); 
        }

    }
}