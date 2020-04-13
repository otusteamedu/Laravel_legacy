<?php

namespace App\Http\Controllers\Cms\Mpolls;

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
    public function store(Request $request)
    {
        ddd($request->input(), $request->all());
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

//        $mpoll->with('quotas')->first();
//        dd($mpoll->quotas);
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
    public function update(Request $request, Mpoll $mpoll)
    {
        $mpoll->update($request->all());
        $mpoll->quotas()->detach();
//        dd($request->all(), $mpoll);
        $quotas = $request->input('quotas', []);
        $completes = $request->input('completes', []);
        $sents = $request->input('sent', []);
//        dd($request->input() ,$mpoll,$quotas,$completes,$sents);
        for ($quota = 0; $quota < count($quotas); $quota++) {
            if ($quotas[$quota] != '') {
                $mpoll->quotas()->attach($quotas[$quota], [
                    'completes' => $completes[$quota],
                    'sent' => $sents[$quota]
                ]);
            }
        }
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
