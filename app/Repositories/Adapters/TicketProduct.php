<?php


namespace App\Repositories\Adapters;


use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Interfaces\Adapters\IProduct;
use App\Repositories\Interfaces\ITicketRepository;

/**
 *
 *
 * Class TicketProduct
 * @package App\Repositories\Adapters
 */
class TicketProduct implements IProduct
{
    private $ticket;
    private $ticketRepository;
    /**
     * Создание объекта возможно только через статический метод getById()
     *
     * TicketProduct constructor.
     * @param Ticket $ticket
     */
    private function __construct(Ticket $ticket, ITicketRepository $ticketRepository)
    {
        $this->ticket = $ticket;
        $this->ticketRepository = $ticketRepository;
    }
    /**
     * Идентификатор, по которому будем искать исходных объект со стороны корзины
     * @return int
     */
    public function GetId(): int
    {
        return $this->ticket->id;
    }

    /**
     * Найти себя по индентификатору, сохраненному в корзине/заказе
     * @param int $id
     * @return IProduct
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function getById(int $id): IProduct
    {
        app()->make('ITicketRepository');
    }

    /**
     * Узнать стоимость. В общем случае может быть завязана на систему скидок и прочее
     * @return float
     */
    public function GetPrice(): float
    {
        // TODO: Implement GetPrice() method.
    }

    /**
     * Проверить доступность для покупки
     * @return bool
     */
    public function GetAvailable(): bool
    {
        // TODO: Implement GetAvailable() method.
    }

    /**
     * Имя, под которым объект будет храниться в корзине/заказе
     * @return string
     */
    public function GetName(): string
    {
        // TODO: Implement GetName() method.
    }

    /**
     * Покупаемый объект должен быть реализован. В терминах корзины - значит продан.
     * В понятии покупаемого объекта - значит заблокирован
     *
     * @param User $user
     */
    public function Release(User $user): void
    {
        // TODO: Implement Release() method.
    }

    /**
     * Реализован ли объект?
     * @return bool
     */
    public function IsReleased(): bool
    {
        // TODO: Implement IsReleased() method.
    }
}
