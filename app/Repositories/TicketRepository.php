<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\Ticket;
use App\Repositories\Interfaces\IShowingPriceRepository;
use App\Repositories\Interfaces\ITicketRepository;

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

    public function getPrice(Ticket $ticket): int
    {
        $price = $this->priceRepository->getPrice($ticket->movieShowing, $ticket->place);
    }
}
