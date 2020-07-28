<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transport\Bus;
use App\Models\Validator\BusValidator;

class BusController extends Controller
{
    public function index()
    {
        $data = Bus::paginate(10);
        $view = view('bus', ['items' => $data])->render();
        return (new Response($view));
    }

    public function check(Request $request)
    {
        $post = $request->all();

        $bus = Bus::where(['register' => $post['register']])->first();
        if ($bus) {
            $isAvailable = $bus->isAvailable(new BusValidator(), $post['date']);
            echo $isAvailable;
        }
    }

    public function formcheck()
    {
        $view = view('checkbus')->render();
        return (new Response($view));
    }
}
