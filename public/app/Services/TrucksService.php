<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\TrucksRepository;

class TrucksService
{
    private $trucksRepository;

    public function __construct(TrucksRepository $trucksRepository)
    {
        $this->trucksRepository = $trucksRepository;
    }

    public function index()
    {
        return $this->trucksRepository->index();
    }

    public function store(Request $request)
    {
        $this->trucksRepository->store($request);
    }

    public function show($id)
    {
        return $this->trucksRepository->show($id);
    }

    public function edit($id)
    {
        $this->trucksRepository->edit($id);
    }

    public function update(Request $request, $model)
    {
        $this->trucksRepository->update($request, $model);
    }

    public function destroy($model)
    {
        $this->trucksRepository->destroy($model);
    }
}
