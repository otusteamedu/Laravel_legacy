<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cms\Adverts\Request\StoreAdvertRequest;
use App\Models\Advert;
use App\Services\Adverts\AdvertsService;
use App\Services\Header\HeaderService;
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
    private $cookieController;
    private $headerService;


    public function __construct(
        AdvertsService $advertService,
        MessagesService $messagesService,
        LogHandler $logHandler,
        CookieController $cookieController,
        HeaderService $headerService
    ) {
        $this->advertService = $advertService;
        $this->messagesService = $messagesService;
        $this->logHandler = $logHandler;
        $this->cookieController = $cookieController;
        $this->headerService = $headerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       $headerData = $this->headerService->getHeaderData($request);
       $pages = $this->advertService->page(8);

       return view('home.home',
           [
               'pages' => $pages,
               'divisionList' => $headerData['divisionList'],
               'townList' => $headerData['townList'],
               'town_id'=> $headerData['town_id'],
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

        $headerData = $this->headerService->getHeaderData($request);

        return view('home.adverts.create',
                [
                    'divisionList' => $headerData['divisionList'],
                    'townList' => $headerData['townList'],
                    'town_id'=> $headerData['town_id'],
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
            $advert = $this->advertService->storeAdvert($data);
            $this->logHandler->logDaily(': Store Advert successful');

            return redirect(route('home.show', ['locale'=>'ru', 'advert'=>$advert->id]));

        } catch (\Exception $e) {
            $this->logHandler->logSlack(': Store Advert Error ');
        }

       // return redirect(route('home.index', ['locale'=>'ru']));
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
        $headerData = $this->headerService->getHeaderData($request);
        $advert = $this->advertService->showItem($advert->id);

        return view('home.adverts.show',
            [
                'advert' => $advert,
                'divisionList' => $headerData['divisionList'],
                'townList' => $headerData['townList'],
                'town_id'=> $headerData['town_id'],
            ]);
    }

    public function edit($id)
    {
        //
    }

    public function update()
    {
        //
    }


    public function destroy($id)
    {
        //
    }


}
