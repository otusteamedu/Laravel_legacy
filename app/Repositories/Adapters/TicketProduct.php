<?php


namespace App\Repositories\Adapters;


use App\Helpers\Views\AdminHelpers;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Interfaces\Adapters\IProduct;
use App\Repositories\Interfaces\ITicketRepository;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\ITicketService;

/**
 *
 *
 * Class TicketProduct
 * @package App\Repositories\Adapters
 */
class TicketProduct implements IProduct
{
    /**
     * @var Ticket
     */
    private $ticket;
    /**
     * @var ITicketService
     */
    private $ticketService;
    /**
     * @var IOrderService
     */
    private $orderService;

    /**
     * Создание объекта возможно только через статический метод getById()
     *
     * TicketProduct constructor.
     * @param Ticket $ticket
     * @param ITicketService $ticketService
     * @param IOrderService $orderService
     */
    private function __construct(Ticket $ticket, ITicketService $ticketService, IOrderService $orderService)
    {
        $this->ticket = $ticket;
        $this->ticketService = $ticketService;
        $this->orderService = $orderService;
    }
    /**
     * Идентификатор, по которому будем искать исходных объект со стороны корзины
     * @return int
     */
    public function GetId(): int {
        return $this->ticket->id;
    }
    /**
     * Найти себя по индентификатору, сохраненному в корзине/заказе
     * @param int $id
     * @return IProduct
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function getById(int $id): ?IProduct
    {
        /** @var ITicketRepository $ticketRepository */
        $ticketService = app()->make(ITicketService::class);
        /** @var IOrderService $ticketRepository */
        $orderService = app()->make(IOrderService::class);
        /** @var Ticket $ticket */
        $ticket = $ticketService->getByPrimary($id);
        if($ticket) {
            return new self($ticket, $ticketService, $orderService);
        }

        return null;
    }
    /**
     * Узнать стоимость. В общем случае может быть завязана на систему скидок и прочее
     * @return int
     */
    public function GetPrice(): int {
        return $this->ticketService->GetTicketPrice($this->ticket);
    }
    /**
     * Проверить доступность для покупки
     * @return bool
     */
    public function GetAvailable(): bool {
        return $this->ticketService->canBuy($this->ticket);
    }
    /**
     * Имя, под которым объект будет храниться в корзине/заказе
     * Формат: Билет на фильм <movie> <date>
     * @return string
     */
    public function GetName(): string {
        $showing = $this->ticket->movieShowing;
        $datetime = $showing->datetime;
        $movie = $showing->movieRental->movie;

        return __(
            'public.ticket.ticket_name',
            [
                'movie' => $movie->name,
                'date' => $datetime->format(AdminHelpers::FORMAT_SITE_DATE),
                'time' => $datetime->format(AdminHelpers::FORMAT_SITE_TIME)
            ]
        );
    }
    /**
     * Имя, под которым объект будет храниться в корзине/заказе
     * Формат: Билет на фильм <movie>. Сеанс <date>. Кинотеатр <cinema>, зал №<hall_number> "<hall_name>"
     * @return array
     */
    public function GetDescription(): array {
        $showing = $this->ticket->movieShowing;
        $rental = $showing->movieRental;
        $hall = $showing->hall;
        $datetime = $showing->datetime;
        $cinema = $rental->cinema;
        $movie = $rental->movie;
        $place = $this->ticket->place;

        return [
            'movie' => [
                'name' => __('public.ticket.movie_name'),
                'value' => __('public.ticket.movie_value', ['name' => $movie->name])
            ],
            'cinema' => [
                'name' => __('public.ticket.cinema_name'),
                'value' => __(
                    'public.ticket.cinema_value',
                    ['name' => $cinema->name, 'address' => $cinema->address]
                )
            ],
            'showing' => [
                'name' => __('public.ticket.showing_name'),
                'value' => __(
                    'public.ticket.showing_value',
                    [
                        'date' => $datetime->format(AdminHelpers::FORMAT_SITE_DATE),
                        'time' => $datetime->format(AdminHelpers::FORMAT_SITE_TIME)
                    ]
                )
            ],
            'hall' => [
                'name' => __('public.ticket.hall_name'),
                'value' => __(
                    'public.ticket.hall_value',
                    ['number' => $hall->number, 'name' => $hall->name]
                )
            ],
            'place' => [
                'name' => __('public.ticket.place_name'),
                'value' => __(
                    'public.ticket.place_value',
                    ['row' =>  $place->row_number, 'place' => $place->place_number]
                )
            ]
        ];
    }
    /**
     * Покупаемый объект должен быть реализован. В терминах корзины - значит продан.
     * В понятии покупаемого объекта - значит заблокирован
     * @param User $user
     */
    public function Release(User $user): void {
        $this->ticketService->releaseTicket($this->ticket);
    }
    /**
     * Отмена реализации
     */
    public function CancelRelease(): void {
        $this->ticketService->freeTicket($this->ticket);
    }
    /**
     * Реализован ли объект?
     * @return bool
     */
    public function IsReleased(): bool {
        return $this->ticketService->isReleased($this->ticket);
    }
    /**
     * Билет не может быть добавлен к заказу если он уже там есть
     * Метод на данный момент не используем
     *
     * @inheritDoc
     */
    public function validateOrderAdd(Order $order): bool {
        return true;
    }
}
