<?php

namespace App\Listeners\Cache\Location;

use App\Services\Events\Models\Location\LocationEvent;
use App\Services\Location\Repositories\LocationCachedRepository;

class ClearLocationCache
{

    /** @var LocationCachedRepository */
    private $locationCachedRepository;

    /**
     * ClearCountryCache constructor.
     * @param  LocationCachedRepository  $locationCachedRepository
     */
    public function __construct(LocationCachedRepository $locationCachedRepository) {
        $this->locationCachedRepository = $locationCachedRepository;
    }

    /**
     * Handle the event.
     *
     * @param  LocationEvent  $event
     * @return void
     */
    public function handle(LocationEvent $event)
    {
        $this->locationCachedRepository->clearSearchCache([
            'user_id' => $event->getLocation()->user->id,
        ]);
    }
}
