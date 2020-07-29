<?php

namespace App\Jobs;

use App\Models\Group;
use App\Models\Post;
use App\Models\Student;
use App\Models\TelegramUser;
use App\Models\User;
use App\Notifications\StudentNotification;
use App\Services\Telegram\TelegramService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class SendNotificationsToStudentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Post
     */
    private $post;

    /**
     * Create a new job instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @param TelegramService $telegramService
     * @return void
     */
    public function handle(TelegramService $telegramService)
    {
        $telegramUsers = $telegramService->getTelegramUsersByGroupsInPost($this->post);

        Notification::send($telegramUsers, new StudentNotification($this->post));
    }
}
