<?php


namespace App\Services\Users;


use App\Models\Group;
use App\Models\User;
use App\Services\Users\Handlers\SendBalanceEmail;
use App\Services\Users\Repositories\UsersRepositoryInterface;

/**
 * Class UsersEmailsService
 * Класс для отправки e-mail сообщений пользователям
 *
 * @package App\Services\Users
 */
class UsersEmailsService
{
    /**
     * @var SendBalanceEmail
     */
    private $sendBalanceEmail;
    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * UsersEmailsService constructor.
     *
     * @param SendBalanceEmail         $sendBalanceEmail
     * @param UsersRepositoryInterface $usersRepository
     */
    public function __construct(SendBalanceEmail $sendBalanceEmail, UsersRepositoryInterface $usersRepository)
    {
        $this->sendBalanceEmail = $sendBalanceEmail;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Отправить сообщение о текущем балансе клиенту
     *
     * @param int $userId
     *
     * @throws Exceptions\UserNotFoundException
     */
    public function balance(int $userId)
    {
        $this->sendBalanceEmail->handle($userId);
    }

    /**
     * Отправить сообщение о текущем балансе клиентам (только с долгом или всем)
     *
     * @param bool $ifDebt
     *
     * @throws Exceptions\UserNotFoundException
     */
    public function balanceAll(bool $ifDebt = true)
    {
        $users = $this->usersRepository->search(Group::CLIENTS, 0);

        if ($ifDebt) {
            $users = $users->where('balance', '<', 0);
        }

        /** @var User $item */
        foreach ($users->all() as $item) {
            $this->balance($item->id);
        }
    }
}
