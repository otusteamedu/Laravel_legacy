<?php

namespace App\Console\Commands\Messages;

use App\Services\Adverts\AdvertsService;
use App\Services\Messages\MessagesService;
use Illuminate\Console\Command;

class MessageToAdverts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:send 
                           {adverts* : id adverts} 
                           {--a|--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add message to any adverts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
     * @return int
     */
    public function handle()
    {
        $message = $this->ask("write message");
        $adverts = $this->argument('adverts');
        $isAdmin = $this->option('admin');
        MessageRepository::addMessage($message, $adverts, $isAdmin, $this->messagesService  );

    }
}
