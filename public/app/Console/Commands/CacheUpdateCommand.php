<?php

namespace App\Console\Commands;

use App\Models\Clients\Client;
use App\Services\Repositories\CachedRepositories\CachedClientRepository;
use App\Services\Repositories\Config;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;

class CacheUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private  $cachedClientRepository;

    public function __construct(CachedClientRepository $cachedClientRepository)
    {
        $this->cachedClientRepository = $cachedClientRepository;
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $ttl = $this->argument('ttl');
        $ttl = $this->choice('Select TTL:', [10, 20, 50, 100], 20);

        $perPage = Config::CLIENTS_PAGINATE;
        $clients = Client::all();
        $totalClients = count($clients);
        $counter = 0;
        $page = 1;

        $progressBar = new ProgressBar($this->output, $totalClients);
        $progressBar->start();

        while ($counter < $totalClients) {

//            $clients = Client::skip($counter)->take($perPage)->paginate($perPage);

            $clients = Client::paginate($perPage, ['*'], 'page', $page);

            $this->cachedClientRepository->addCachePage($clients, $page, $ttl);


            $counter = $counter + 5;
            $page++;
            $progressBar->advance();
        }

        $progressBar->finish();

    }
}
