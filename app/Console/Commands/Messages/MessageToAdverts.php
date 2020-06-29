<?php

namespace App\Console\Commands\Messages;

use App\Services\Messages\Handler\AddMessageHandler;
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
                           {--a | admin : admin on default user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add message to any adverts';
    /**
     * @var AddMessageHandler
     */
    private $addMessageHandler;

    /**
     * Create a new command instance.
     *
     * @param AddMessageHandler $addMessageHandler
     */


    public function __construct(AddMessageHandler $addMessageHandler)
    {

        parent::__construct();
        $this->addMessageHandler = $addMessageHandler;
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

        $this->addMessageHandler->addMessageToAnyAdverts($message, $adverts, $isAdmin);

    }

}
