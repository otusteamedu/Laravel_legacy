<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send
                             {user: user id}
                             {--email=* : List of emails}
                             {--A|--all= : Send to all users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle sending all emails';

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
//        $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
//        $name = $this->ask('What is your name?');
//        dump($name);
        $this->info('Display this on the screen');
        $this->comment('Display comment on the screen');
        $this->question('Display question  on the screen');
        $this->error('Something went wrong!');
        $this->line('Display line on the screen');

//        dd($name, $this->arguments(), $this->option());
        $headers = ['Name', 'Email'];
        $users = User::all(['name', 'email'])->toArray();
        dd( $users
        );
        $this->table($headers, $users);

        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        foreach ($users as $user) {
//            $this->performTask($user);

            $bar->advance();
            sleep(1);
        }

        $bar->finish();


    }
}
