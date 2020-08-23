<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use App\Http\Requests;


class CookieController extends Controller
{

    const COOKIE_TIME_MINUTES = 10;

    public function setCookie(Request $request){

        $response = new Response(redirect(route('home.index', ['locale'=>'ru'])));
        $response->withCookie( cookie('town', $request->town_id,self::COOKIE_TIME_MINUTES));

        return $response;
    }
    public function getCookie(Request $request){
        $value = $request->cookie('town');
        echo $value;
    }
}
