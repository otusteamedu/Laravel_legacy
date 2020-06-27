<?php


namespace Lara\Calendar\Services\Repositories;


use Carbon\Carbon;

class CalendarRepository implements CalendarInterface
{

    public function generateCalendar($date, $dates=[])
    {
        $currentDay = $this->firstDateCalendar($date);
        $month = $this->carbonDay($date)->month;
        $calendar = collect([]);


        for ($i = 0; $i < 42; $i++)
        {
            $currentDay->addDay();
            $weekDay = $currentDay->dayOfWeek;
            ($weekDay == 0 || $weekDay == 6)?   $workDay = 'text-danger': $workDay = '';
            $currentDay->month != $month ? $anotherMonth = 'text-secondary' : $anotherMonth = '';
            in_array($currentDay->toDateTimeString(),$dates)? $marked='green' :  $marked='';

            $calendar->push([
                'date' => $currentDay->format('Y-m-d'),
                'dayNum' => $currentDay->day,
                'anotherMonth' => $anotherMonth,
                'workDay' => $workDay,
                'marked' => $marked,
            ]);
        }

        return  $calendar;

    }

    public function firstDateCalendar($date)
    {
        $carbonDay = $this->carbonDay($date);

        $firstDateMonth = Carbon::create($carbonDay->year, $carbonDay->month, 1);
        $firstDateMonth->dayOfWeek == 0
            ? $weekDayFirstDayMonth = 7
            : $weekDayFirstDayMonth = $firstDateMonth->dayOfWeek;
        return $firstDateMonth->subDays($weekDayFirstDayMonth);
    }

    public function carbonDay($date)
    {
        $date==null
            ? $carbonDay = Carbon::today()
            : $carbonDay = Carbon::createFromFormat('Y-m-d', $date);
        return $carbonDay;

    }
}
