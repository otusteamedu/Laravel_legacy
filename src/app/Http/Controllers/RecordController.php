<?php

namespace App\Http\Controllers;

use App\Services\Records\RecordService;

class RecordController extends Controller
{
    /**
     * @var RecordService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        RecordService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Страница просмотра записей (история)
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $records = $this->service->getMyRecord();
        return view('records.index', [
            'records' => $records
        ]);
    }
}
