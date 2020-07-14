<?php


namespace App\Services\Users\Handlers;


use App\Jobs\Queue;
use App\Mail\Users\UsersBalanceMail;
use App\Services\Users\Exceptions\UserNotFoundException;
use App\Services\Users\UsersService;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendBalanceEmail
 *
 * Метод отправки письма о текущем балансе пользователя
 *
 * @package App\Services\Users\Handlers
 */
class SendBalanceEmail
{
    /**
     * @var UsersService
     */
    private $usersService;

    /**
     * SendBalanceEmail constructor.
     *
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function handle(int $userId)
    {
        $user = $this->usersService->findUser($userId);

        if (!$user->id) {
            throw new UserNotFoundException($userId);
        }

        Mail::to($user)->queue(
            (new UsersBalanceMail($user))->onQueue(Queue::EMAILS)
        );
    }
}
