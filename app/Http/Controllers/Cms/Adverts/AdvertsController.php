<?php

namespace App\Http\Controllers\Cms\Adverts;

use App\Http\Controllers\Cms\Adverts\Request\StoreAdvertRequest;
use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Services\Adverts\AdvertsService;
use Illuminate\Http\Request;

class AdvertsController extends Controller
{

    protected $advertService;

    public function __construct(AdvertsService $advertService)
    {
        $this->advertService = $advertService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start = microtime(true);
        $advertList = $this->advertService->showAdvertList();
        return view('cms.adverts.index', ['advertList'=>$advertList, 'start'=>$start]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisionList = $this->advertService->showDivisionList();
        $townList = $this->advertService->showTownList();

        return view('cms.adverts.create',
            [
                'divisionList'=>$divisionList,
                'townList'=>$townList
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertRequest $request)
    {
        $data = $request->getFormData();
        $this->advertService->storeAdvert($data);

        return redirect(route('adverts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Advert $advert
     * @return void
     */
    public function show(Advert $advert)
    {
        return view('cms.adverts.show', ['advert' => $advert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {
        return view('cms.adverts.edit', ['advert' => $advert]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAdvertRequest $request
     * @param Advert $advert
     * @return void
     */
    public function update(StoreAdvertRequest $request, Advert $advert)
    {
        $this->advertService->updateAdvert($advert, $request->all());
        return redirect(route('adverts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Advert $advert
     * @return void
     */
    public function destroy(Advert $advert)
    {
        $this->advertService->deleteAdvert($advert);

        return redirect(route('adverts.index'));
    }
}
