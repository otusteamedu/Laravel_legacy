<?php

namespace App\Http\Controllers\Cms\Mpolls;

use App\Http\Controllers\Cms\Mpolls\Requests\StoreMpollRequest;
use App\Http\Controllers\Cms\Mpolls\Requests\UpdateMpollRequest;
use App\Http\Controllers\Controller;
use App\Models\Mpoll;
use App\Models\Quota;
use App\Policies\Abilities;
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
        $this->authorize(Abilities::VIEW_ANY, Mpoll::class);
        $mpolls = $this->mpollsService->search([]);
//        dd($mpolls);
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
        $this->authorize(Abilities::CREATE, Mpoll::class);
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
     *
     */
    public function store(StoreMpollRequest $request)
    {
        $this->authorize(Abilities::CREATE, Mpoll::class);
        $mpoll = $this->mpollsService->create($request->getFormData());

        View::share([

        ]);
        return redirect()
            ->route('cms.mpolls.index')
            ->with(['success' => __('messages.rec_created', ['id' => $mpoll->id])]);
        return redirect()->route('cms.mpolls.edit', ['mpoll' => $mpoll->id]);
//        ddd($request->input(), $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Mpoll $mpoll
     * @return \Illuminate\Http\Response
     */
    /* public function show(Mpoll $mpoll)
     {
         //
     }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Mpoll $mpoll
     * @return \Illuminate\Http\Response
     */
    public function edit(Mpoll $mpoll)
    {
        $this->authorize(Abilities::VIEW_ANY, Mpoll::class);
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
     */
    public function update(UpdateMpollRequest $request, Mpoll $mpoll)
    {
        $this->authorize(Abilities::VIEW_ANY, Mpoll::class);
        $data = $request->getFormData();
        $this->mpollsService->update($mpoll, $request->getFormData());
        return redirect(route('cms.mpolls.edit', $mpoll))
            ->with(['success' => __('messages.rec_updated', ['id' => $mpoll->id])]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Mpoll $mpoll
     *
     */
    public function destroy(Mpoll $mpoll)
    {
        $this->authorize(Abilities::DELETE, Mpoll::class);
        $this->mpollsService->destroy($mpoll);
        return redirect()
            ->route('cms.mpolls.index')
            ->with(['success' => __('messages.rec_deleted', ['id' => $mpoll->id])]);
    }
}
