<?php

namespace App\Http\Controllers\Admin\Movies;

use App\Models\Country;
use App\Repositories\Countries\ICountryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    protected $countryRepository;

    public function __construct(ICountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.countries.index', [
            'dataList' => $this->countryRepository->search()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //
        //$this->beforeSave();
        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100'
        ]);
        $this->countryRepository->createFromArray($request->all());
        return redirect(route('admin.countries.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
        return view('admin.countries.edit', [
            'dataItem' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Country $country)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:countries,name,' . $country->id . '|max:100'
        ]);

        $this->countryRepository->updateFromArray($country, $request->all());
        return redirect(route('admin.countries.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
        $this->countryRepository->remove($country);
        return redirect(route('admin.countries.index'));
    }
}
