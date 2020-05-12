<?php

namespace App\Http\Controllers\Cms\Mpolls;

use App\Http\Controllers\Cms\Mpolls\Requests\StoreMpollRequest;
use App\Http\Controllers\Cms\Mpolls\Requests\UpdateMpollRequest;
use App\Http\Controllers\Controller;
use App\Models\Mpoll;
use App\Models\Quota;
use App\Services\Mpolls\MpollsService;
use Illuminate\Http\Request;
use View;

class MpollsController extends Controller
{

    /**
     * @var MpollsService
     */
public MpollsService $mpollsService;

    /**
     * MpollsController constructor.
     * @param MpollsService $mpollsService
     */
    public function __construct(
        MpollsService $mpollsService
    )
    {
        $this->mpollsService = $mpollsService;
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mpolls = $this->mpollsService->search([]) ;
//        dd($mpolls, $mpolls[0], $mpolls[0]['value'], $mpolls[0]->value);
        View::share([
            'mpolls' => $mpolls
        ]);
        return view('cms.mpolls.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", name) AS id_name',
        ]);
        $quotas = Quota::selectRaw($columns)->get();
        \View::share([
            'quotas' => $quotas
        ]);
        return view('cms.mpolls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMpollRequest $request)
    {
        $mpoll = $this->mpollsService->create($request->getFormData());

        View::share([

        ]);
        return redirect()->route('cms.mpolls.edit', ['mpoll' => $mpoll->id]);
//        ddd($request->input(), $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Mpoll $mpoll
     * @return \Illuminate\Http\Response
     */
    public function show(Mpoll $mpoll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Mpoll $mpoll
     * @return \Illuminate\Http\Response
     */
    public function edit(Mpoll $mpoll)
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", name) AS id_name',
        ]);
        $quotas = Quota::selectRaw($columns)->get();
        \View::share(['mpoll' => $mpoll,
            'quotas' => $quotas
        ]);
        return view('cms.mpolls.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Mpoll $mpoll
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMpollRequest $request, Mpoll $mpoll)
    {
        $data = $request->getFormData();
dd($data);
        $this->mpollsService->update($mpoll, $request->getFormData());
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Mpoll $mpoll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mpoll $mpoll)
    {
        //
    }
}
