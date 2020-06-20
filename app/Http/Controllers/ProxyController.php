<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\StoreProxyRequest;
use App\Models\Planner\PlannerProxy;
use App\Services\Planner\Proxy\ProxyService;

class ProxyController extends Controller
{
    /**
     * @var ProxyService
     */
    public $proxyService;

    public function __construct(ProxyService $proxyService)
    {
        $this->proxyService = $proxyService;
    }

    public function index()
    {
        \View::share(Array(
            'proxies' => \Auth::getUser()->proxies()->paginate(10)
        ));

        return view('main.proxy.index');
    }

    public function create()
    {
        return view('main.proxy.create');
    }

    public function delete(PlannerProxy $proxy)
    {
        $this->proxyService->deleteProxyHandler->handle($proxy);
        return redirect(route('proxy'));
    }

    public function edit(PlannerProxy $proxy)
    {
        if($proxy->user()->get()->first()->id == \Auth::user()->id) {
            \View::share(Array(
                'proxy' => $proxy
            ));
            return view('main.proxy.create');
        } else {
            abort(403);
        }
    }

    public function store(StoreProxyRequest $request)
    {
        $this->proxyService->storeProxy($request);

        return redirect(route('proxy'));
    }
}
