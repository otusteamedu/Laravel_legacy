<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\OrdersRepository;

class OrdersService
{
    const RULES = [
        'name' => 'required|max:255',
        'region_id' => 'required',
    ];

    private $ordersRepository;
    private $validationService;

    public function __construct(OrdersRepository $ordersRepository, ValidationService $validationService)
    {
        $this->ordersRepository = $ordersRepository;
        $this->validationService = $validationService;
    }

    public function index()
    {
        return $this->ordersRepository->index();
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
            $this->ordersRepository->store($data);
        }
    }

    public function edit($id)
    {
        $this->ordersRepository->edit($id);
    }

    public function update(Request $request, $model)
    {
        if ($this->validate($request)) {
            $data['name'] = $request->name;
            $data['region_id'] = $request->region_id;
            $this->ordersRepository->update($data, $model);
        }
    }

    public function destroy($model)
    {
        $this->ordersRepository->destroy($model);
    }
}
