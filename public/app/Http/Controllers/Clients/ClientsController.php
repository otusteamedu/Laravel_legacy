<?php

namespace App\Http\Controllers\Clients;

use App\Models\Clients\Client;
use App\Services\Cache\CacheKeys;
use App\Services\ClientsService;
use App\Services\Repositories\CachedRepositories\CachedClientRepository;
use App\Services\ValidationService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Crm\CrmController;

class ClientsController extends CrmController
{
    const RULES = [
        'name' => 'required|max:255',
        'region_id' => 'required',
    ];

    private $clientsService;
    private $validationService;
    private $cacheClientRepository;

    public function __construct(ClientsService $clientsService,
                                ValidationService $validationService,
                                CachedClientRepository $cachedClientRepository)
    {
        $this->validationService = $validationService;
        $this->clientsService = $clientsService;
        $this->cacheClientRepository = $cachedClientRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = $this->cacheClientRepository->searchClients($request);

        return view('crm.clients.index', ['items' => $items, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('crm.clients.create', ['leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($this->validationService->validate($request, self::RULES)) {
            $this->clientsService->store($request);
        }

        return redirect(route('crm.clients.index'));
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('crm.clients.edit', ['model' => $client, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Client $client)
    {
        return view('crm.clients.edit', ['model' => $client, 'leftNav' => parent::getLeftNav()]);
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Client $client)
    {
        if ($this->validationService->validate($request, self::RULES)) {
            $this->clientsService->update($request, $client);
        }

        return redirect(route('crm.clients.index'));
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $this->clientsService->destroy($client);

        return redirect(route('crm.clients.index'));
    }
}
