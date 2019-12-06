<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\MovieShowing;
use App\Models\Place;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

interface ITicketRepository extends IBaseRepository {
    public function IsReleased(Ticket $ticket): bool;
    public function GetTicketPrice(Ticket $ticket): int;
    public function find(MovieShowing $showing, Place $place): ?Model;
    public function createTicket(MovieShowing $showing, Place $place): Model;
}
