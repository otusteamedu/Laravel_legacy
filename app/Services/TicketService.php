<?php


namespace App\Services;

use App\Base\Service\BaseService;
use App\Base\Service\ServiceException;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Interfaces\ITicketRepository;
use App\Services\Exceptions\TicketException;
use App\Services\Interfaces\IMovieShowingService;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\ITicketService;
use App\Services\Interfaces\IUserService;

class TicketService extends BaseService implements ITicketService {
    private $showingService;
    private $userService;


    public function __construct(IMovieShowingService $showingService, IUserService $userService) {
        parent::__construct();

        $this->showingService = $showingService;
        $this->userService = $userService;
    }
    /**
     * Билет реализван, если у него установлен покупатель
     * @param Ticket $ticket
     * @return bool
     */
    public function IsReleased(Ticket $ticket): bool {
        return !empty($ticket->owner);
    }
    /**
     * Билет просрочен, если просрочен сеанс
     * @param Ticket $ticket
     * @return bool
     */
    public function isExpired(Ticket $ticket): bool
    {
        return $this->showingService->ShowingIsExpired($ticket->movieShowing);
    }
    /**
     * По идее лишний метод, но на всякий случай проверим существование связанных элементов
     * @param Ticket $ticket
     * @return bool
     */
    public function isValid(Ticket $ticket): bool
    {
        if(!($place = $ticket->place) || !($hall = $place->hall) || !($cinema = $hall->cinema))
            return false;

        if(!$this->showingService->IsValid($ticket->movieShowing))
            return false;

        return true;
    }
    /**
     * Возможно ли купить данный билет.
     * 1. Проверить целостность
     * 2. Сеанс не просрочен
     * 3. Билет не куплен
     * 4. У билета есть цена
     * @param Ticket $ticket
     * @return bool
     */
    public function canBuy(Ticket $ticket): bool
    {
        return $this->isValid($ticket)
            && !$this->isExpired($ticket)
            && !$this->IsReleased($ticket)
            && ($this->GetTicketPrice($ticket) > 0);
    }
    public function GetTicketPrice(Ticket $ticket): int {
        /** @var ITicketRepository $repository */
        $repository = $this->getRepository();
        return $repository->GetTicketPrice($ticket);
    }

    private function valdateGetTicket(MovieShowing $showing, Place $place) {
        $te = new TicketException();
        if(!$place->hall || !($place->hall->cinema))
            $te->add(__('errors.tickets.invalidplace'));

        if(!$this->showingService->IsValid($showing))
            $te->add(__('errors.tickets.invalidshowing'));

        // нельзя создать билет на просроченный сеанс
        if($this->showingService->ShowingIsExpired($showing))
            $te->add(__('errors.showings.expired'));
        $te->assert();
    }

    private function valdateTicket(Ticket $ticket) {
        if($this->IsReleased($ticket))
            throw new TicketException(__('errors.tickets.released'));
    }
    /**
     * Создание/получение билета, как разделяемого объекта.
     * Создать тикет может любой посетитель
     * @inheritDoc
     */
    public function receiveTicket(MovieShowing $showing, Place $place): Ticket {
        $this->valdateGetTicket($showing, $place);

        /** @var ITicketRepository $repository */
        $repository = $this->getRepository();

        /** @var Ticket $ticket */
        if($ticket = $repository->find($showing, $place)) {
            $this->valdateTicket($ticket);
            return $ticket;
        }

        return $repository->createTicket($showing, $place, $this->userService->currentUser());
    }

    /**
     * Получить несколько билетов за раз, возможно только если
     * выполняются заявки на все билеты
     *
     * @inheritDoc
     */
    public function receiveTickets(MovieShowing $showing , array $places): array {
        $resultTickets = [];
        // места, на которые еще не созданы билеты
        $newPlaces = [];
        /** @var ITicketRepository $repository */
        $repository = $this->getRepository();

        $te = new TicketException();
        foreach ($places as $place) {
            try {
                $this->valdateGetTicket($showing , $place);
                /** @var Ticket $ticket */
                if($ticket = $repository->find($showing, $place)) {
                    $this->valdateTicket($ticket);
                    $resultTickets[] = $ticket;
                }
                else
                    $newPlaces[] = $place;
            }
            catch (ServiceException $ex) {
                $te->merge($ex);
            }
        }
        $te->assert();

        return array_merge($resultTickets, $repository->createTickets($showing, $newPlaces, $this->userService->currentUser()));
    }

    public function releaseTicket(Ticket $ticket, User $owner = null): Ticket {
        /** @var ITicketRepository $repository */
        $repository = $this->getRepository();
        if($owner == null)
            $owner = $this->userService->currentUser();
        return $repository->releaseTicket($ticket, $owner);
    }

    public function freeTicket(Ticket $ticket): Ticket
    {
        /** @var ITicketRepository $repository */
        $repository = $this->getRepository();
        return $repository->freeTicket($ticket);
    }

    public function getShowingTickets(MovieShowing $showing, bool $bAll = false): array
    {
        /** @var ITicketRepository $repository */
        $repository = $this->getRepository();
        return $repository->getShowingTickets($showing, $bAll)->toArray();
    }
}

