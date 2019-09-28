<?php

namespace App\Http\Controllers\Clients;

use App\Models\Clients\Client;
use App\Services\ClientsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ClientsController extends Controller
{
    private $clientsService;

    public function __construct(ClientsService $clientsService)
    {
        $this->clientsService = $clientsService;
    }

    /**
     * @return Response
     * @throws \Throwable
     */
    public function index()
    {
        $items = $this->clientsService->index();
        $view = view('clients/index', ['items' => $items])->render();

        return (new Response($view));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new Response(view('clients/create')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->clientsService->store($request);

        return redirect(route('crm.clients.index'));
    }

    /**
     * @param $id
     * @return Response
     * @throws \Throwable
     */
    public function show($id)
    {
        $model = $this->clientsService->show($id);
        $view = view('clients/edit', ['model' => $model])->render();

        return (new Response($view));
    }

    /**
     * @param Client $client
     * @return Response
     * @throws \Throwable
     */
    public function edit(Client $client)
    {
        $view = view('clients/edit', ['model' => $client])->render();

        return (new Response($view));
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
