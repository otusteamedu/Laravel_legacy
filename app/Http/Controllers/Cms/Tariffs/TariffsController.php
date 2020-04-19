<?php

namespace App\Http\Controllers\Cms\Tariffs;

use App\Http\Controllers\Cms\Tariffs\Requests\StoreTariffRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Tariffs\Requests\StoreCityRequest;
use App\Models\Tariff;
use App\Policies\Abilities;
use App\Services\Tariffs\TariffsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Gate;


class TariffsController extends Controller
{
    /**
     * @var TariffsService
     */
    protected $tariffsService;

    public function __construct(
        TariffsService $tariffsService
    )
    {
        $this->tariffsService = $tariffsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Tariff $tariff
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Tariff $tariff)
    {
        $this->authorize(Abilities::VIEW, $tariff);

        return view(config('view.cms.tariffs.index'), ['tariffs' => Tariff::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Tariff $tariff
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Tariff $tariff)
    {
        $this->authorize(Abilities::CREATE, $tariff);

        return view(config('view.cms.tariffs.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreTariffRequest $request, Tariff $tariff)
    {
        $this->authorize(Abilities::CREATE, $tariff);

        $data = $request->getFormData();

        try {
            $this->tariffsService->storeTariff($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store tariff error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.tariffs.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tariff $tariff)
    {
        $this->authorize(Abilities::VIEW, $tariff);

        return view(config('view.cms.tariffs.edit'), [
            'tariff' => $tariff,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tariff $tariff)
    {
        $this->authorize(Abilities::UPDATE, $tariff);

        return view(config('view.cms.tariffs.edit'), [
            'tariff' => $tariff,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tariff  $tariff
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Tariff $tariff)
    {
        $this->authorize(Abilities::UPDATE, $tariff);

        try {
            $tariff->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update tariff error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.tariffs.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        return false;
    }

}
