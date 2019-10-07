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

    /**
     * Get the middlewarwe the job should pass through.
     *
     * @return array
     */
//    public function middleware()
//    {
//        return [new RateLimited];
//    }

    /** @var User */
    protected $user;
    protected $data;

    public function __construct(User $user, array $data = [])
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * @param User $user
     */
    public function handle()
    {
        echo UserPhotoProcess::class, '@handle:', $this->user->id, PHP_EOL;
        info($this->user->id, $this->data);
        throw new \Exception();
    }
}
