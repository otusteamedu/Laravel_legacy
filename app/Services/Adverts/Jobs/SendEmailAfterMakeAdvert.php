<?php

namespace App\Services\Adverts\Jobs;

use App\Jobs\Queue;
use App\Models\Advert;
use App\Models\User;
use App\Services\Adverts\Handler\SendEmailHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailAfterMakeAdvert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //public $queue = Queue::HIGH;
    private $advert;


    /**
     * Create a new job instance.
     *
     * @param Advert $advert
     * @param User $user
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;

    }

    /**
     * Execute the job.
     *
     * @param SendEmailHandler $sendEmailHandler
     * @return void
     */
    public function handle(SendEmailHandler $sendEmailHandler)
    {
        $sendEmailHandler->handle( $this->advert);
    }
}
