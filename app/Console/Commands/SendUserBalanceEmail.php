<?php

namespace App\Console\Commands;

use App\Services\Users\UsersEmailsService;
use Illuminate\Console\Command;

class SendUserBalanceEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:balance 
                                {ids?* : ID of the user to send the message with the balance} 
                                {--D|--debt : To send only to users who have a debt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending messages about balance to users';
    /**
     * @var UsersEmailsService
     */
    private $usersEmailsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UsersEmailsService $usersEmailsService)
    {
        parent::__construct();
        $this->usersEmailsService = $usersEmailsService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('ids')) {
            foreach ($this->argument('ids') as $id) {
                $this->usersEmailsService->balance($id);
            }
        } else {
            $this->usersEmailsService->balanceAll($this->option('debt'));
        }
    }
}
