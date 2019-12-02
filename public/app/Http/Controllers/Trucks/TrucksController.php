<?php

namespace App\Http\Controllers\Trucks;

use App\Models\Transport\Truck;
use App\Services\TrucksService;
use Illuminate\Http\Request;
use App\Http\Controllers\Crm\CrmController;
use Illuminate\Support\Facades\Gate;

class TrucksController extends CrmController
{
    private $trucksService;

    public function __construct(TrucksService $trucksService)
    {
        $this->trucksService = $trucksService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = $this->trucksService->index();

        return view('crm.trucks.index', [
            'items' => $items,
            'leftNav' => $this->getLeftNav(),
            'edit' => Gate::allows('edit-transport')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('crm.trucks.create', ['leftNav' => $this->getLeftNav()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($this->trucksService->validate($request)) {
            $this->trucksService->store($request);
        }

        return redirect(route('crm.trucks.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Truck $truck)
    {
        return view('crm.trucks.edit',['model' => $truck, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Truck $truck
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Truck $truck)
    {
        return view('crm.trucks.edit', ['model' => $truck, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Request $request
     * @param Truck $truck
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Truck $truck)
    {
        $this->trucksService->update($request, $truck);

        return redirect(route('crm.trucks.index'));
    }

    /**
     * @param Truck $truck
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Truck $truck)
    {
        $this->trucksService->destroy($truck);

        return redirect(route('crm.trucks.index'));
    }
}
