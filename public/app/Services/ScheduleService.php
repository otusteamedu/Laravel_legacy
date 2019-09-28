<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Repositories\ScheduleRepository;

class ScheduleService
{
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index()
    {
        return $this->scheduleRepository->index();
    }

    public function store(Request $request)
    {
        $this->scheduleRepository->store($request);
    }

    public function show($id)
    {
        return $this->scheduleRepository->show($id);
    }

    public function edit($id)
    {
        $this->scheduleRepository->edit($id);
    }

    public function update(Request $request, $model)
    {
        $this->scheduleRepository->update($request, $model);
    }

    public function destroy($model)
    {
        $this->scheduleRepository->destroy($model);
    }
}
