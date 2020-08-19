<?php

namespace App\Jobs;

use App\Models\Film;
use App\Services\FilmsService;
use App\Services\UsersService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Уведомление модераторов о готовности фильма к публикации
 * Class NotifyJob
 * @package App\Jobs
 */
class FilmNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Film
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Film $film
     */
    public function __construct(Film $film)
    {
        $this->message = $film;
    }

    /**
     * Execute the job.
     *
     * @param UsersService $userGroupsService
     * @return void
     */
    public function handle(UsersService $usersService)
    {
        echo 'Notify...';
        $moderators = $usersService->notifyModerators();
        $usersService->notify($moderators, ['subject'=> 'Уведомление', 'message' => sprintf('Фильм[id-%d] готов к публикации', $this->message->id)]);
        \Log::channel('processlog')->info(sprintf('Уведомление о готовности фильма[id-%d] к публикации отправлено модераторам', $this->message->id));
    }
}
