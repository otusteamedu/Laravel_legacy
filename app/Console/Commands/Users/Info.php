<?php

namespace App\Console\Commands\Users;

use App\Models\User;
use Illuminate\Console\Command;

class Info extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:info

                            {--s|--short : Display only id an email of user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List info about user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::select(['id', 'email', 'name'])->get()->toArray();
        $this->call('test:command');
    }

    private function showShortUserInfo(User $user)
    {
        $this->line("{$user->id}: {$user->email}");
    }

    private function showFullUserInfo(User $user)
    {

    }
}
