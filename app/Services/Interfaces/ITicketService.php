<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface ITicketService extends IBaseService {
    public function getTicketPrice(Ticket $ticket): int;
    /**
     * @param MovieShowing $showing
     * @param Place $place
     * @return Ticket
     */
    public function receiveTicket(MovieShowing $showing, Place $place): Ticket;
    /**
     * @param MovieShowing $showing
     * @param array $place
     * @return array
     */
    public function receiveTickets(MovieShowing $showing, array $place): array;

    public function isExpired(Ticket $ticket): bool;

    public function isReleased(Ticket $ticket): bool;

    public function isValid(Ticket $ticket): bool;

    public function canBuy(Ticket $ticket): bool;

    public function releaseTicket(Ticket $ticket, User $owner = null): Ticket;

    public function freeTicket(Ticket $ticket): Ticket;

    public function getShowingTickets(MovieShowing $showing, bool $bAll = false): array;
}
