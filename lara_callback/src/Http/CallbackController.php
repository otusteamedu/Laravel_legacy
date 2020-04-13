<?php
/**
 * Created by PhpStorm.
 * User: Albina
 * Date: 08.11.2019
 * Time: 20:30
 */

namespace Lara\Callback\Http;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Lara\Callback\Http\Mail\CallbackOrderMail;


class CallbackController extends Controller
{
    public function index()
    {

        return View::make('callback::index');
    }

    public function send(Request $request)
    {
        $data['email'] = config('callback.admin_email');
        $data['name'] = $request['name'];
        $data['phone'] = $request['phone'];

        Mail::to($data['email'])->send(new CallbackOrderMail($data));

        return response()->json(array('msg' => 'Заявка отправлена! Мы Вам перезвоним.'), 200);


    }
}