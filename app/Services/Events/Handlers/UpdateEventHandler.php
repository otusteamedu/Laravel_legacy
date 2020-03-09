<?php

namespace App\Services\Events\Handlers;

use App\Models\Event;
use App\Services\Events\Repositories\EventRepositoryInterface;

/**
 * Class UpdateEventHandler
 * @package App\Services\Events\Handlers
 */
class UpdateEventHandler
{
    private $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
    )
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle(Event $event, array $data): Event
    {
        if (isset($data['created_at'])) {
            $data['created_at'] = Carbon::create()->subDay();
        }

        if (isset($data['description'])) {
            $data['description'] = ucfirst(trim($data['description']));
        }

        if (isset($data['region'])) {
            $data['region'] = ucfirst(trim($data['region']));
        }

        if (isset($data['locality'])) {
            $data['locality'] = ucfirst(trim($data['locality']));
        }

        if (isset($data['lat'])) {
            $data['lat'] = (float)($data['lat']);
        }

        if (isset($data['long'])) {
            $data['long'] = (float)($data['long']);
        }

        if (isset($data['type_id'])) {
            $data['type_id'] = (int)($data['type_id']);
        }

        if (isset($data['author_id'])) {
            $data['author_id'] = (int)($data['author_id']);
        }

        if (isset($data['picture_id'])) {
            $event->pictures()->detach();
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
            $event->participants()->detach();
            $participantList = [];

            foreach ($data['participant_id'] as $participantId) {
                $participantId = (int)$participantId;

                if ($participantId > 0) {
                    $participantList[$participantId] = ['is_successful' => 0];
                }
            }

            $event->participants()->sync($participantList);
        }

        return $this->eventRepository->updateFromArray($event, $data);
    }
}
