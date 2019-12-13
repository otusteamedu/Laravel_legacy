<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Ticket;
use App\Repositories\Interfaces\IShowingPriceRepository;
use App\Repositories\Interfaces\ITicketRepository;
use Illuminate\Database\Eloquent\Model;

class TicketRepository extends BaseRepository implements ITicketRepository
{
    private $priceRepository;

    public function __construct(IShowingPriceRepository $priceRepository) {
        parent::__construct();
        $this->priceRepository = $priceRepository;
    }
    public function IsReleased(Ticket $ticket): bool
    {
        return !empty($ticket->owner);
    }

    public function GetTicketPrice(Ticket $ticket): int {
        return $this->priceRepository->getPrice($ticket->movieShowing, $ticket->place);
    }

    public function find(MovieShowing $showing , Place $place): ?Model
    {
        // TODO: Implement find() method.
    }

    public function createTicket(MovieShowing $showing , Place $place): Model {
        // TODO: Implement createTicket() method.
    }
}
