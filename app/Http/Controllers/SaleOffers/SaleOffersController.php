<?php

namespace App\Http\Controllers\SaleOffers;

use App\Http\Controllers\Controller;
use App\Services\Offers\OffersService;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SaleOffersController extends Controller
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
     * @param Request $request
     * @return Application|Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $key = $request->user()->id . '|' . $request->getUri();

        return Cache::remember($key, env('DEFAULT_CACHE_TTL'), function () {
            $offers = $this->offersService->searchCachedOffers();

            return view('plain.sale', [
                'offers' => $offers,
                'categories' => Category::all()
            ])->render();
        });
    }

    /**
     * @return Application|Factory|\Illuminate\View\View
     */
    public function indexWithoutCacheForMetric()
    {
        return view('plain.sale', [
            'offers' => Offer::paginate(),
            'categories' => Category::all(),
        ]);

    }
}
