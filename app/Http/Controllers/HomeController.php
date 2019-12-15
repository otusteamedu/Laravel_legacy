<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
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
