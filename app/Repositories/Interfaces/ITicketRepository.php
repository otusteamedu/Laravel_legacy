<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ITicketRepository extends IBaseRepository {
    public function GetTicketPrice(Ticket $ticket): int;
    public function find(MovieShowing $showing, Place $place): ?Ticket;
    public function createTicket(MovieShowing $showing, Place $place, User $creator = null): Ticket;
    public function createTickets(MovieShowing $showing, array $places, User $creator = null): array;
    public function getShowingTickets(MovieShowing $showing, bool $bAll = false): Collection;
    public function releaseTicket(Ticket $ticket, User $owner): Ticket;
    public function freeTicket(Ticket $ticket): Ticket;
}
