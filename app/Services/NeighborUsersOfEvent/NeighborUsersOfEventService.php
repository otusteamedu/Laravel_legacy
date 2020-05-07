<?php

namespace App\Services\NeighborUsersOfEvent;

use App\Models\Event;
use App\Services\NeighborUsersOfEvent\Resolvers\NeighborUsersByEventResolver;

class NeighborUsersOfEventService
{
    private $neighborUsersByEventResolver;

    public function __construct(NeighborUsersByEventResolver $neighborUsersByEventResolver)
    {
        $this->neighborUsersByEventResolver = $neighborUsersByEventResolver;
    }

    public function getNeighborUsersByEvent(Event $event): array
    {
        $neighborUsersByEvent = $this->neighborUsersByEventResolver->resolve();

        return $neighborUsersByEvent;
    }
}
