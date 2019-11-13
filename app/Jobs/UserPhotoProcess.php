<?php

namespace App\Jobs;

use App\Jobs\Middleware\RateLimited;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserPhotoProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected function middleware()
    {
        return [
            new RateLimited,
        ];
    }

    /** @var User */
    protected $user;
    protected $data;

    public function __construct(
        User $user,
        array $data = []
    )
    {
        echo '__construct', PHP_EOL;
        $this->user = $user;
        $this->data = $data;
    }

    public function handle()
    {
        throw new \Exception();
        echo 'Hey', UserPhotoProcess::class, '@handle:', $this->user->id, PHP_EOL;
        info($this->user->id, $this->data);
    }

    public function failed(\Exception $exception)
    {
        echo 'Failed', PHP_EOL;
    }

}
