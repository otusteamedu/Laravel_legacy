<?php

namespace App\Jobs;

use App\Mail\UserRegistered;
use App\Models\User;
use App\Notifications\SlackFailedJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisteredUserPostProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        // @ToDo и вот тут уже вызываем отправку уведомления автору события
        // и пока что заглушка для рассылки уведомлений пользователям поблизости
        \Mail::send((new UserRegistered($this->user)));

        return true;
    }

    // @ToDo: сюда приходит только объект Exception, но не JobFailed
    public function failed(\Exception $exception)
    {
        \Log::channel(['slack'])->error('Job failed. ' . self::class, ['exception' => $exception]);
        /* @ToDo: do it.
        $slackFailedJob = new SlackFailedJob();
        $slackFailedJob->toSlack($exception);*/
    }
}
