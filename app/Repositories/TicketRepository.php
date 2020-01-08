<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Interfaces\ITicketRepository;
use App\Services\Interfaces\IShowingPriceService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TicketRepository extends BaseRepository implements ITicketRepository
{
    private $priceService;

    public function __construct(IShowingPriceService $priceService) {
        parent::__construct();
        $this->priceService = $priceService;
    }

    public function GetTicketPrice(Ticket $ticket): int {
        return $this->priceService->getPrice($ticket->movieShowing, $ticket->place);
    }

    public function getShowingTickets(MovieShowing $showing, bool $bAll = false): Collection {
         $builder = $this->getModel()->newQuery()
            ->where('movie_showing_id', $showing->id);
         if(!$bAll)
             $builder->whereNotNull('released_user_id');
        return $builder->get();
    }

    public function find(MovieShowing $showing , Place $place): ?Ticket
    {
        return $this->getModel()->newQuery()
            ->where('movie_showing_id', $showing->id)
            ->where('place_id', $place->id)
            ->get()->first();
    }
    /**
     * Создать билет на основе сеанса и места
     * @param MovieShowing $showing
     * @param Place $place
     * @param User|null $creator
     * @return Ticket
     * @throws \App\Base\WrongNamespaceException
     */
    public function createTicket(MovieShowing $showing , Place $place, User $creator = null): Ticket {
        /** @var Ticket $ticket */
        $ticket = $this->getModel();
        $ticket->movieShowing()->associate($showing);
        $ticket->place()->associate($place);
        // создавать билет можно анонимно, но если пользователь авторизован как клиент или оператор,
        // то сохранится создатель билета
        if($creator)
            $ticket->creator()->associate($creator);
        $ticket->created_at = Carbon::now();

        $ticket->save();

        return $ticket;
    }
    /**
     * @param MovieShowing $showing
     * @param array $places
     * @param User|null $creator
     * @return array
     * @throws \Exception
     */
    public function createTickets(MovieShowing $showing, array $places, User $creator = null): array
    {
        $tickets = [];
        DB::beginTransaction();
        try {
            foreach ($places as $place) {
                if($place instanceof Place)
                    $tickets[] = $this->createTicket($showing, $place, $creator);
            }
            DB::commit();
        }
        catch (\Exception $exception) {
            // если не создался хотябы один билет откатываем все
            // и проталкиваем исключение далее
            DB::rollBack();
            throw $exception;
        }

        return $tickets;
    }
    /**
     * Блокируем использование билета. С этого момента его невозможно добавить к заказу,
     * А все заказы, где этот билет присутствует, невозможно отправить
     *
     * @param Ticket $ticket
     * @param User|null $owner
     * @return Ticket
     */
    public function releaseTicket(Ticket $ticket, User $owner): Ticket {
        $ticket->owner()->associate($owner);
        $ticket->released_at = Carbon::now();
        $ticket->save();

        return $ticket;
    }
    /**
     * @param Ticket $ticket
     * @return Ticket
     */
    public function freeTicket(Ticket $ticket): Ticket {
        $ticket->owner()->dissociate();
        $ticket->released_at = Carbon::now();
        $ticket->save();

        return $ticket;
    }
}

