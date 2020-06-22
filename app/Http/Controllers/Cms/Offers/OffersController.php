<?php

namespace App\Http\Controllers\Cms\Offers;

use App\Http\Controllers\Cms\Offers\Requests\StoreOfferRequest;
use App\Http\Controllers\Cms\Offers\Requests\UpdateOfferRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Offer;
use App\Models\Project;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Offers\Generators\OfferTemplateQRGenerator;
use App\Services\Offers\OffersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Imagick;


class OffersController extends Controller
{
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
     * @param Offer $offer
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Offer $offer, User $user)
    {
        $this->authorize(Abilities::VIEW, $offer);
        $projects = Project::where('user_id', '=', $user->getId())->pluck('id')->toArray();
        //dd($projects);

        if ($user->isAdmin()){
            $offers = Offer::paginate();
        }else{
            $offers = Offer::whereIn('project_id', $projects)->paginate();
        }

        //dd($offers);

        return view(config('view.cms.offers.index'), [
            'offers' => $offers
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Offer $offer
     * @param Uesr $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Offer $offer, User $user)
    {
        $this->authorize(Abilities::CREATE, $offer);

        $cities = City::all();
        $categories = Category::all();

        if ($user->isAdmin())
            $projects = Project::all()->pluck('name', 'id')->toArray();
        else
            $projects = Project::where('user_id', '=', $user->getId())->pluck('name', 'id')->toArray();

        return view(config('view.cms.offers.create'), [
            'projects' => $projects,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOfferRequest $request
     * @param Offer $offer
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreOfferRequest $request, Offer $offer)
    {
        $this->authorize(Abilities::CREATE, $offer);

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

        return redirect(route(config('view.cms.offers.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Offer $offer
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Offer $offer, User $user)
    {
        $this->authorize(Abilities::VIEW, $offer);

        $cities = City::all();
        $categories = Category::all();

        if ($user->isAdmin())
            $projects = Project::all()->pluck('name', 'id')->toArray();
        else
            $projects = Project::where('user_id', '=', $user->getId())->pluck('name', 'id')->toArray();

        return view(config('view.cms.offers.edit'), [
            'offer' => $offer,
            'cities' => $cities,
            'categories' => $categories,
            'projects' => $projects,
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
        $this->authorize(Abilities::UPDATE, $offer);

        return view(config('view.cms.offers.edit'), [
            'offer' => $offer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $this->authorize(Abilities::UPDATE, $offer);

        $data = $request->getFormData();

        try {
            $offer->update($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update offer error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.offers.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        return false;
    }
}
