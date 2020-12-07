<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\TrucksRepository;
use App\Services\ValidationService;

class TrucksService
{
    const RULES = [
        'brand' => 'required|max:50',
        'plate' => 'required|max:12',
        'cars' => 'required|integer',
    ];
    private $trucksRepository;
    private $validationService;

    public function __construct(TrucksRepository $trucksRepository, ValidationService $validationService)
    {
        $this->trucksRepository = $trucksRepository;
        $this->validationService = $validationService;
    }

    public function index()
    {
        return $this->trucksRepository->index();
    }

    public function validate(Request $request)
    {
        return $this->validationService->validate($request, self::RULES);
    }

    public function store(Request $request)
    {
        if ($this->validate($request)) {
            $data['brand'] = $request->brand;
            $data['plate'] = $request->plate;
            $data['cars'] = $request->cars;

            $this->trucksRepository->store($data);
        }
    }

    public function update(Request $request, $model)
    {
        if ($this->validate($request)) {
            $data['brand'] = $request->brand;
            $data['plate'] = $request->plate;
            $data['cars'] = $request->cars;

            $this->trucksRepository->update($data, $model);
        }
    }

    public function destroy($model)
    {
        $this->trucksRepository->destroy($model);
    }
}
