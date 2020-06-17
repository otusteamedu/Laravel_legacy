<?php

namespace App\Http\Controllers\Api\Events\Resources;

use App\Services\Events\EventsService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventsResource extends ResourceCollection
{
    public function getEventsService(): EventsService
    {
        return app()->make(EventsService::class);
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request = null)
    {
        return [
            'data' => EventResource::collection($this),
            'count' => $this->count(),
        ];
    }
}
