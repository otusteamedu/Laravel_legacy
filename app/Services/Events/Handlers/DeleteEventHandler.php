<?php

namespace App\Services\Events\Handlers;

use App\Models\Event;
use App\Services\Events\Repositories\EventRepositoryInterface;

/**
 * Class DeleteEventHandler
 * @package App\Services\Events\Handlers
 */
class DeleteEventHandler {
    private $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
    )
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle(Event $event): void
    {
        $event->delete();
    }
}
