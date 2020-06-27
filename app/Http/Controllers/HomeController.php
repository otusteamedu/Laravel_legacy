<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cms\Adverts\Request\StoreAdvertRequest;
use App\Models\Advert;
use App\Services\Adverts\AdvertsService;
use App\Services\Messages\MessagesService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    protected $advertService;
    protected $messagesService;

    public function __construct(AdvertsService $advertService, MessagesService $messagesService)
    {
        $this->advertService = $advertService;
        $this->messagesService = $messagesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $start = microtime(true);
       $pages = $this->advertService->page(8);
       return view('home.home', ['pages' => $pages, 'start'=>$start, 'day'=>$this->calendar()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!Auth::user())  return redirect('/login');

        $divisionList = $this->advertService->showDivisionList();
        $townList = $this->advertService->showTownList();


        return view('home.adverts.create',
                [
                    'divisionList'=>$divisionList,
                    'townList'=>$townList
                ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StoreAdvertRequest $request)
    {
        try {
            $data = $request->getFormData();
            $this->advertService->storeAdvert($data);

            $context =['method'=> $request->method(), 'USER' =>'#'.Auth::user()->id.'->'.Auth::user()->name];
            \Log::channel('daily')->info(__METHOD__ . ': Store Advert successful ', $context);

        } catch (\Exception $e) {
            \Log::channel('slack')->critical(__METHOD__ . ': Store Advert Error ');
        }

        return redirect(route('home.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param Advert $advert
     * @return void
     */
    public function show(Advert $advert)
    {
        //$advert = $this->advertService->showItem($id);

        return view('home.adverts.show', ['advert' => $advert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function calendar()
    {
        //$today = strtotime(date('Y-n-d', time()));
        $today = Carbon::createFromFormat('Y-m-d', '2020-11-10');
        $month = $today->month;

        $date2 = Carbon::create($today->year, $today->month, 1);
        $date2->dayOfWeek == 0 ? $weekDayFirstDayMonth = 7 : $weekDayFirstDayMonth = $date2->dayOfWeek;
        $date2->subDays($weekDayFirstDayMonth);

        $calendar = collect([]);

        for ($i = 0; $i < 42; $i++)
        {
            $date2->addDay();
            $weekDay = $date2->dayOfWeek;
            ($weekDay == 0 || $weekDay == 6)?   $workDay = 'red': $workDay = '';
            $date2->month != $month ? $anotherMonth = 'another-month' : $anotherMonth = '';

           // $property =
            $calendar->push([
                'date' => $date2->format('Y-m-d'),
                'dayNum' => $date2->day,
                'anotherMonth' => $anotherMonth,
                'workDay' => $workDay,
            ]);
            //array_push($calendar, $property);

        }

        return  $calendar;

    }
}
