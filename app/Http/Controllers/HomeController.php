<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cms\Adverts\Request\StoreAdvertRequest;
use App\Models\Advert;
use App\Services\Adverts\AdvertsService;
use App\Services\Messages\MessagesService;
use Auth;
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
       $pages = $this->advertService->page(8);
       return view('home.home', ['pages' => $pages]);
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
        $data = $request->getFormData();
        $this->advertService->storeAdvert($data);
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
}
