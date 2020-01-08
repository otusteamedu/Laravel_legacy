<?php

namespace App\Http\Controllers;

use App\Services\Grammar\GrammarService;
use App\Services\Orthography\OrthographyService;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $grammarService;
    private $orthographyService;

    public function __construct(
        GrammarService $grammarService,
        OrthographyService $orthographyService
    )
    {
        $this->grammarService = $grammarService;
        $this->orthographyService = $orthographyService;
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listGrammar = $this->grammarService->list();
        $listOrthography = $this->orthographyService->list();
        return view('index')->with([
            'listGrammar' => $listGrammar,
            'listOrthography' => $listOrthography
        ]);
    }

    public function cc()
    {
        echo '123';

//        phpinfo();
//        echo '1';
//        $coverage = new CodeCoverage;
//        $coverage->filter()->addDirectoryToWhitelist('vendor/phpunit/php-code-coverage');
//        $coverage->start('GrammarTest');
//echo '2';
//        $coverage->stop();
//        echo '3';
//       $writer = new \SebastianBergmann\CodeCoverage\Report\Clover;
//        $writer->process($coverage, '/tmp/clover.xml');
//        $writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
//        $writer->process($coverage, '/tmp/code-coverage-report');
    }
}
