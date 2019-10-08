<?php

namespace App\Http\Controllers\Clients;

use App\Models\Clients\Client;
use App\Services\ClientsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Crm\CrmController;

class ClientsController extends CrmController
{
    private $clientsService;

    public function __construct(ClientsService $clientsService)
    {
        $this->clientsService = $clientsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = $this->clientsService->index();

        return view('crm.clients.index', ['items' => $items, 'layout' => 'crm.layouts.nav_' . parent::layout()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('crm.clients.create', ['layout' => 'crm.layouts.nav_' . parent::layout()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->clientsService->store($request);

        return redirect(route('crm.clients.index'));
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('crm.clients.edit', ['model' => $client, 'layout' => 'crm.layouts.nav_' . parent::layout()]);
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Client $client)
    {
        return view('crm.clients.edit', ['model' => $client, 'layout' => 'crm.layouts.nav_' . parent::layout()]);
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Client $client)
    {
        $this->clientsService->update($request, $client);

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
