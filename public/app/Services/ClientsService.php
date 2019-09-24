<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\ClientsRepository;

class ClientsService
{
    private $clientsRepository;

    public function __construct(ClientsRepository $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }

    public function index()
    {
        return $this->clientsRepository->index();
    }

    public function store(Request $request)
    {
        $this->clientsRepository->store($request);
    }

    public function show($id)
    {
        return $this->clientsRepository->show($id);
    }

    public function edit($id)
    {
        $this->clientsRepository->edit($id);
    }

    public function update(Request $request, $model)
    {
        $this->clientsRepository->update($request, $model);
    }

    public function destroy($model)
    {
        $this->clientsRepository->destroy($model);
    }
}
