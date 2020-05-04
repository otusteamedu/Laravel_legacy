<?php

namespace App\Jobs;

use App\Mail\NewReason;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Reason;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $reason;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reason $reason)
    {
        $this->reason = $reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        /** @var User $user */
        foreach ($users as $user) {
            if (!$user->email) {
                continue;
            }

            Mail::to($user['email'])->send(new NewReason($this->reason));
        }
    }
}
