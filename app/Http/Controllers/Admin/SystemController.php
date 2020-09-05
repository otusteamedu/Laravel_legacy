<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    /**
     * @var ActivityLogService
     */
    private $activityLogService;

    /**
     * HomeController constructor.
     * @param ActivityLogService $activityLogService
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      /*  $articles = $this->activityLogService->allPaginated();
        $categoriesList = $this->categoriesService->getCategoriesList();*/

        return view('admin.commands', []);
    }

    public function clearCache()
    {
        Artisan::call("cache:clear");
        $result = Artisan::output();
        \Session::flash('alert-success', sprintf('Команда выполнена. Результат: %s', $result));

        return redirect()->route('system.commands');
    }

    public function publishArticles()
    {
        Artisan::call("articles:publish-pending-items");
        $result = Artisan::output();
        \Session::flash('alert-success', sprintf('Команда выполнена. Результат: %s', $result));

        return redirect()->route('system.commands');
    }

    public function logView()
    {
        $rows = $this->activityLogService->allPaginated();
        return view('admin.logview', ['rows'=> $rows]);
    }
}
