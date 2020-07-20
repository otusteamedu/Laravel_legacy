<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\UserGroup;
use App\Services\ArticlesService;
use App\Services\UserGroupsService;
use App\Services\UsersService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Уведомление модераторов о готовности статьи к публикации
 * Class NotifyJob
 * @package App\Jobs
 */
class ArticleNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Article
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->message = $article;
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
        $moderators = $usersService->getUsersByGroupName(UserGroup::ADMIN_GROUP);
        $usersService->notify($moderators, ['subject'=> 'Уведомление', 'message' => sprintf('Cтатья[id-%d] готова к публикации', $this->message->id)]);
        \Log::channel('processlog')->info(sprintf('Уведомление о готовности статьи[id-%d] к публикации отправлено модераторам', $this->message->id));
    }
}
