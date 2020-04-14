<?php

namespace App\Http\Controllers\Cms\Offers;

use App\Http\Controllers\Cms\Offers\Requests\StoreOfferRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Offers\Requests\StoreCityRequest;
use App\Models\City;
use App\Models\Offer;
use App\Models\Project;
use App\Models\User;
use App\Services\Offers\OffersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use View;


class OffersController extends Controller
{
    /**
     * @var OffersService
     */
    protected $offersService;

    public function __construct(
        OffersService $offersService
    )
    {
        $this->offersService = $offersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cms.offers.index', ['offers' => Offer::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('create-offer')) {
            $projects = Project::all();
            $cities = City::all();

            return view('cms.offers.create', [
                'projects' => $projects,
                'cities' => $cities,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreOfferRequest $request)
    {
        $data = $request->getFormData();

        try {
            $this->offersService->storeOffer($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store offer error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.offers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Offer $offer)
    {
        return view('cms.offers.show', [
            'offer' => $offer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Offer $offer)
    {
        if (Gate::allows('update-offer')) {
            return view('cms.offers.edit', [
                'offer' => $offer,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Offer $offer)
    {
        $this->authorize(Abilities::UPDATE, $offer);

        try {
            $this->offersService->updateOffer($offer, $request->all());
            $offer->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update offer error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.offers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
