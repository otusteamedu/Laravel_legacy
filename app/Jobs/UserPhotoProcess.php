<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserPhotoProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var User */
    protected $user;
    protected $data;

    public function __construct(
        User $user,
        array $data = []
    )
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function handle()
    {
        throw new \Exception();
    }

}
