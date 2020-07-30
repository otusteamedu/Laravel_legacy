<?php

namespace App\Services\Users\Jobs;

use App\Jobs\Queue;
use App\Models\User;
use App\Services\Users\Handlers\SendEmailVerificationHandler;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public $queue = Queue::HIGH;

    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        array $data
    )
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        SendEmailVerificationHandler $sendEmailVerificationHandler
    )
    {
        $sendEmailVerificationHandler->handle($this->user);
    }
}
