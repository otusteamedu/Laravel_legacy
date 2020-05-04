<?php

namespace App\Console\Commands;

use App\Models\EventType;
use App\Services\Countries\CountriesService;
use App\Services\Events\EventsService;
use App\Services\EventTypes\EventTypesService;
use Illuminate\Console\Command;

class CreateEventItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event-item:create
                            {--D|--delete-cache : Should the events cache be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command allows you to create an event item without using the website interface.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param EventsService $eventsService
     * @param CountriesService $countriesService
     *
     * @return mixed
     */
    public function handle(
        EventsService $eventsService,
        CountriesService $countriesService,
        EventTypesService $eventTypesService
    ) {
        $options = $this->options();

        $countryIdToNameMap = [];
        $countriesService->searchCountries([])->each(function ($item) use (&$countryIdToNameMap) {
            return $countryIdToNameMap[$item->id] = $item->name;
        });

        $eventTypeIdToNameMap = [];
        $eventTypesService->searchEventTypes([])->each(function ($item) use (&$eventTypeIdToNameMap) {
            return $eventTypeIdToNameMap[$item->id] = $item->name;
        });

        $eventFields['description'] = $this->ask('Enter a brief description of the event.');
        $eventFields['country_id'] = array_flip($countryIdToNameMap)[$this->choice(
            'Enter event country',
            $countryIdToNameMap,
            reset($countryIdToNameMap)
        )];

        $eventFields['type_id'] = array_flip($eventTypeIdToNameMap)[$this->choice(
            'Enter event type',
            $eventTypeIdToNameMap,
            reset($eventTypeIdToNameMap)
        )];

        $eventFields['author_id'] = $this->ask('Enter event author id');
        $eventFields['region'] = $this->ask('Enter event region');
        $eventFields['locality'] = $this->ask('Enter event locality');
        $eventFields['lat'] = $this->ask('Enter event latitude');
        $eventFields['long'] = $this->ask('Enter event longitude');
        $eventFields['is_solved'] = 0;

        $event = $eventsService->storeEvent($eventFields);

        if (!empty($options['delete-cache'])) {
            shell_exec('yes | php artisan cache:warm-up -D');
        }

        $this->info('Event created successfully ' . $event->id . PHP_EOL);
    }
}
