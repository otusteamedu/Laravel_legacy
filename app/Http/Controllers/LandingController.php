<?php


namespace App\Http\Controllers;


use App\Services\Analyzers\PhpInsights;
use App\Services\GitOperations;
use App\Services\RepositoryService;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }


}
