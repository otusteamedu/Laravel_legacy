<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\ClientsRepository;

class ClientsService
{
    const RULES = [
        'name' => 'required|max:255',
        'region_id' => 'required',
    ];

    private $clientsRepository;
    private $validationService;

    public function __construct(ClientsRepository $clientsRepository, ValidationService $validationService)
    {
        $this->clientsRepository = $clientsRepository;
        $this->validationService = $validationService;
    }

    public function index()
    {
        return $this->clientsRepository->index();
    }

    public function validate(Request $request)
    {
        return $this->validationService->validate($request, self::RULES);
    }

    public function store(Request $request)
    {
        if ($this->validate($request)) {
            $data['name'] = $request->name;
            $data['region_id'] = $request->region_id;
            $this->clientsRepository->store($data);
        }
    }

    public function edit($id)
    {
        $this->clientsRepository->edit($id);
    }

    public function update(Request $request, $model)
    {
        if ($this->validate($request)) {
            $data['name'] = $request->name;
            $data['region_id'] = $request->region_id;
            $this->clientsRepository->update($data, $model);
        }
    }

    public function destroy($model)
    {
        $this->clientsRepository->destroy($model);
    }
}
