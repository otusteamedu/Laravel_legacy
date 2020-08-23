<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cms\Adverts\Request\StoreAdvertRequest;
use App\Models\Advert;
use App\Services\Adverts\AdvertsService;
use App\Services\Log\Handler\LogHandler;
use App\Services\Messages\MessagesService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    protected $advertService;
    protected $messagesService;
    private $logHandler;

    public function __construct(AdvertsService $advertService, MessagesService $messagesService, LogHandler $logHandler)
    {
        $this->advertService = $advertService;
        $this->messagesService = $messagesService;
        $this->logHandler = $logHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       $divisionList = $this->advertService->showDivisionList();
       $townList = $this->advertService->showTownList();
       $pages = $this->advertService->page(8);

       $request->cookie('town') //TODO убрать в кукиконтроллер
           ? $cookieTownValue = $request->cookie('town')
           : $cookieTownValue = 'all';

       return view('home.home',
           [
               'pages' => $pages,
               'divisionList' => $divisionList,
               'townList' => $townList,
               'town_id'=>$cookieTownValue, //TODO из куки брать
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        if (!Auth::user())  return redirect('/login');

        $divisionList = $this->advertService->showDivisionList();
        $townList = $this->advertService->showTownList();

        $request->cookie('town') //TODO убрать в кукиконтроллер
            ? $cookieTownValue = $request->cookie('town')
            : $cookieTownValue = 'all';

        return view('home.adverts.create',
                [
                    'divisionList'=>$divisionList,
                    'townList'=>$townList,
                    'town_id'=>$cookieTownValue, //TODO из куки брать
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdvertRequest $request
     * @return void
     */
    public function store(StoreAdvertRequest $request)
    {
        try {
            $data = $request->getFormData();
            $this->advertService->storeAdvert($data);
            $this->logHandler->logDaily(': Store Advert successful');
        } catch (\Exception $e) {
            $this->logHandler->logSlack(': Store Advert Error ');
        }

        return redirect(route('home.index', ['locale'=>'ru']));
    }


    /**
     * Display the specified resource.
     *
     * @param Advert $advert
     * @param Request $request
     * @return void
     */
    public function show(Advert $advert, Request $request)
    {
        $divisionList = $this->advertService->showDivisionList();
        $townList = $this->advertService->showTownList();
        $advert = $this->advertService->showItem($advert->id);

        $request->cookie('town') //TODO убрать в кукиконтроллер
            ? $cookieTownValue = $request->cookie('town')
            : $cookieTownValue = 'all';

        return view('home.adverts.show',
            [
                'advert' => $advert,
                'divisionList' => $divisionList,
                'townList' => $townList,
                'town_id'=>$cookieTownValue, //TODO из куки брать
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
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


}
