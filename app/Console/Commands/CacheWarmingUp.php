<?php

namespace App\Console\Commands;

use App\Services\Adverts\AdvertsService;
use App\Services\Messages\MessagesService;
use Illuminate\Console\Command;

class CacheWarmingUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warming Cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        parent::__construct();
//    }

    protected $advertService;
    protected $messagesService;

    public function __construct(AdvertsService $advertService, MessagesService $messagesService)
    {
        $this->advertService = $advertService;
        $this->messagesService = $messagesService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Cache::forget('homeList');
        \Cache::forget('advertList');
        \Cache::forget('messageList');
        $this->advertService->showAdvertList();
        $this->advertService->page(8);
        $this->messagesService->showMessageList();
        echo 'Cache warmed';
    }
}
