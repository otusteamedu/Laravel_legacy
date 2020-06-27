<?php


namespace Lara\Calendar\Controllers;


use Illuminate\Routing\Controller;
use Lara\Calendar\Services\CalendarService;

class CalendarController extends Controller
{

    protected $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function index()
    {
        return view('calendar::index');
    }

    public function calendar($date=null)
    {
        $dates=[];
        $data = $this->calendarService->generateCalendar($date, $dates);
        return view('calendar::index', ['data'=>$data]);
       // return generateCalendar();
    }

}
