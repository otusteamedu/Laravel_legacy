<?php

namespace App\Console\Commands;

use App\Jobs\UserPhotoProcess;
use App\Models\User;
use Illuminate\Console\Command;

class TestRabbitMQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:queue';

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
        for ($i = 0; $i < 1; $i++) {
            $user = User::inRandomOrder()->first();
            echo $user->id, PHP_EOL;
            UserPhotoProcess::dispatch($user, [
                microtime(true),
            ]);
        }
    }
}
