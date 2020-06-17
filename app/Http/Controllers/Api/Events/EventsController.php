<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Api\Events\Requests\StoreEventRequest;
use App\Http\Controllers\Api\Events\Requests\UpdateEventRequest;
use App\Http\Controllers\Api\Events\Resources\EventResource;
use App\Http\Controllers\Api\Events\Resources\EventsResource;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Policies\Abilities;
use App\Services\Events\EventsService;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * @var EventsService
     */
    private $eventsService;

    /**
     * EventsController constructor.
     * @param EventsService $eventsService
     */
    public function __construct(EventsService $eventsService)
    {
        $this->eventsService = $eventsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $eventList = $this->eventsService->getAll();

        return response()->json(new EventsResource($eventList));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $this->authorize(Abilities::CREATE, Event::class);

        try {
            $event = $this->eventsService->storeEvent($request->getFormData());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json([
            'event' => $event
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $this->authorize(Abilities::VIEW, Event::class);

        return response()->json(new EventResource($event));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize(Abilities::UPDATE, [\Auth::user(), Event::class]);

        try {
            $this->eventsService->updateEvent($event, $request->getFormData());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json([
            'event' => $event
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize(Abilities::DELETE, [\Auth::user(), Event::class]);

        try {
            $this->eventsService->deleteEvent($event);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json('', 200);
    }
}
