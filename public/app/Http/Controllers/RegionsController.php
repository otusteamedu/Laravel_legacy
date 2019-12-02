<?php


namespace App\Http\Controllers;


use Illuminate\Http\Response;
use App\Models\Region;


class RegionsController extends Controller
{
    public function index()
    {
        $data = Region::all();
        $view = view('regions', ['items' => $data])->render();
        return (new Response($view));
    }
}
