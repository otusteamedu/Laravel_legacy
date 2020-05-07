<?php

namespace App\Services\Events\Handlers;

use App\Models\Event;
use App\Services\Events\Events\EventCreated;
use App\Services\Events\Repositories\EventRepositoryInterface;
use Carbon\Carbon;

/**
 * Class CreateEventHandler
 * @package App\Services\Events\Handlers
 */
class CreateEventHandler {
    private $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
    )
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle(array $data): Event
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['description'] = ucfirst(trim(htmlentities($data['description'])));
        $data['region'] = ucfirst(trim(htmlentities($data['region'])));
        $data['locality'] = ucfirst(trim(htmlentities($data['locality'])));
        $data['country_id'] = (int)($data['country_id']);
        $data['lat'] = (float)($data['lat']);
        $data['long'] = (float)($data['long']);
        $data['type_id'] = (int)($data['type_id']);
        $data['author_id'] = (int)($data['author_id']);
        $data['is_solved'] = (isset($data['is_solved'])) ? (int)($data['is_solved']) : 0;

        $event = $this->eventRepository->createFromArray($data);

        if (isset($data['picture_id'])) {
            $pictureMap = [];

            foreach ($data['picture_id'] as $pictureId) {
                $pictureId = (int)$pictureId;

                if ($pictureId > 0) {
                    $pictureMap[$pictureId] = null;
                }
            }

            $event->pictures()->sync(array_keys($pictureMap));
        }

        if (isset($data['participant_id'])) {
            $participantList = [];

            foreach ($data['participant_id'] as $participantId) {
                $participantId = (int)$participantId;

                if ($participantId > 0) {
                    $participantList[$participantId] = ['is_successful' => 0];
                }
            }

            $event->participants()->sync($participantList);
        }

        EventCreated::dispatch($event);

        return $event;
    }
}
