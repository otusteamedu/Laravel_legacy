<?php

namespace App\Http\Controllers\SaleOffers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class SaleOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('plain.sale', [
           'offers' => Offer::paginate(),
        ]);
    }
}
