<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\ClientsRepository;

class ClientsService
{
    private $clientsRepository;
    private $validationService;

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
        $data['name'] = $request->name;
        $data['region_id'] = $request->region_id;
        $this->clientsRepository->store($data);
    }

    public function edit($id)
    {
        $this->clientsRepository->edit($id);
    }

    public function update(Request $request, $model)
    {
        $data['name'] = $request->name;
        $data['region_id'] = $request->region_id;
        $this->clientsRepository->update($data, $model);
    }

    public function destroy($model)
    {
        $this->clientsRepository->destroy($model);
    }
}
