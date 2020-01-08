<?php


namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    private $repository;

    public function __construct(IUserRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * @param User $user
     * @param $ability
     * @return mixed
     */
    public function before(User $user, $ability) {
        if($user->isRoot())
            return true;
    }
    /**
     * @param User $user
     * @param Ticket $ticket
     * @return bool
     */
    public function release(User $user, Ticket $ticket): bool {
        // просто надо быть авторизованным
        return $user->id > 0;
    }

    /**
     * @param User $user
     * @param Ticket $ticket
     * @return bool
     */
    public function free(User $user, Ticket $ticket) {
        // билет должен быть заблокирован пользователем
        if($user->id == $ticket->released_user_id)
            return true;
        // либо пользователь должен иметь доступ не ниже "Управление заказами" в модуле "Продажи"
        return $this->repository->requiredAccess($user, "sales" , "U");
    }
    /**
     * @param User $user
     * @param Ticket $ticket
     * @return bool
     */
    public function delete(User $user, Ticket $ticket)
    {
        // удалять билеты можно только под суперпользователем (системные скрипты)
        return false;
    }
}
