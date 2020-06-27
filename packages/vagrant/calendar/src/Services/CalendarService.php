<?php


namespace Lara\Calendar\Services;


use Carbon\Carbon;
use Lara\Calendar\Services\Repositories\CalendarInterface;

class CalendarService
{

    private $calendarRepository;

    public function __construct(CalendarInterface $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function generateCalendar($date, $dates=[])
    {
        return $this->calendarRepository->generateCalendar($date, $dates=[]);
    }


}
