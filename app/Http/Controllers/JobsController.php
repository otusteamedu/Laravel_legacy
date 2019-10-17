<?php
/**
 * Description of JobsController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class JobsController extends Controller
{

    public function index()
    {
        $jobs = DB::table('jobs')->get();

        View::share([
            'jobs' => $jobs,
        ]);

        return response()->view('jobs.index');
    }

    public function failed()
    {
        $failedJobs = DB::table('failed_jobs')->get();

        View::share([
            'failedJobs' => $failedJobs,
        ]);

        return response()->view('jobs.failed');
    }

}