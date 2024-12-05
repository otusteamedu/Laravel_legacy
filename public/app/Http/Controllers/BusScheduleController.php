<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Schedule\BusSchedule;
use App\Models\Region;
use App\Models\Transport\Bus;
use Illuminate\Support\Facades\Cache;

class BusScheduleController extends Controller
{
    public $data;

    public function index()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $key = 'schedule-page-' . $currentPage;

        $data = Cache::remember($key, 1, function () {
            return BusSchedule::paginate(10);
        });

        $view = view('schedule', ['items' => $data])->render();

        return (new Response($view));
    }

    public function add()
    {
        $transports = Bus::all();
        $regions = Region::all();

        $view = view('newschedule', ['transports' => $transports,
            'regions' => $regions])->render();

        return (new Response($view));
    }

    public function store(Request $request)
    {
        if (!empty($request)) {
            $schedule = new BusSchedule();
            $result = $schedule->newRoute($request);

            $view = view('result', ['result' => $result])->render();

            return (new Response($view));
        }
    }
}
