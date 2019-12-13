<?php


namespace App\Http\Controllers;


use App\Services\Analyzers\PhpInsights;
use App\Services\GitOperations;
use GitWrapper\Exception\GitException;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }

    public function try(Request $request, GitOperations $gitOperations, PhpInsights $phpInsights)
    {
        $repository = $request->get('repository');
        if (!$repository) {
            return redirect('/');
        }

        try {
            $storagePath = $gitOperations->clone($repository);
        } catch (GitException $e) {
            return view('landing.try.error', ['error' => $e->getMessage(), 'repository' => $repository]);
        }

        $path = \Storage::path($storagePath);
        $result = $phpInsights->run($path);

        \Storage::deleteDirectory($storagePath);

        $result['repository'] = $repository;
        return view('landing.try.result', $result);
    }
}
