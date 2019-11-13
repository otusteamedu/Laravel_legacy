<?php

namespace App\Console\Commands\Test;

use App\Jobs\Queue;
use App\Jobs\UserPhotoProcess;
use App\Models\User;
use Illuminate\Console\Command;

class TestQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:queue {--c|--count=3: count of jobs to add on queue}';

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

    public function handle(): void
    {
        $count = $this->option('count');

        for ($i = 0; $i < $count; $i++) {
            $this->createJob();
        }
    }

    private function createJob(): void
    {
        $user = $this->getRandomUser();
        echo $user->id, PHP_EOL;
        UserPhotoProcess::dispatch($user, [
            'photo' => $user->photo,
            'time' => microtime(true),
        ])->onConnection(Queue::CONNECTION_RABBITMQ);
    }

    /**
     * @return User
     */
    private function getRandomUser(): User
    {
        return User::inRandomOrder()->first();
    }
}
