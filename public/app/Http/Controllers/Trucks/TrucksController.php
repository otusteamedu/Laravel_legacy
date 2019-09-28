<?php

namespace App\Http\Controllers\Trucks;

use App\Models\Transport\Truck;
use App\Services\TrucksService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TrucksController extends Controller
{
    private $trucksService;

    public function __construct(TrucksService $trucksService)
    {
        $this->trucksService = $trucksService;
    }

    /**
     * @return Response
     * @throws \Throwable
     */
    public function index()
    {
        $items = $this->trucksService->index();
        $view = view('trucks/index', ['items' => $items])->render();

        return (new Response($view));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new Response(view('trucks/create')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->trucksService->store($request);

        return redirect(route('crm.trucks.index'));
    }

    /**
     * @param $id
     * @return Response
     * @throws \Throwable
     */
    public function show($id)
    {
        $model = $this->trucksService->show($id);
        $view = view('trucks/edit', ['model' => $model])->render();

        return (new Response($view));
    }

    /**
     * @param Truck $truck
     * @return Response
     * @throws \Throwable
     */
    public function edit(Truck $truck)
    {
        $view = view('trucks/edit', ['model' => $truck])->render();

        return (new Response($view));
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
     * @throws \Exception
     */

    public function destroy(Truck $truck)
    {
        $this->trucksService->destroy($truck);

        return redirect(route('crm.trucks.index'));
    }
}
