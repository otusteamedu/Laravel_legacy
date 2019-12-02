<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Schedule\BusSchedule;
use Rakit\Validation\Validator;

class IndexController extends Controller
{
    public $html;

    public function index()
    {
        $data = [];
        $view = view('welcome', ['items' => $data])->render();

        return (new Response($view));
    }

    public function show(Request $request)
    {
        $data = $request->all();

        if ($this->checkForm($data, [
                'date1' => 'required',
                'date2' => 'required'
            ])) {

        $schedule = BusSchedule::where([
          ['date', '>=', $data['date1']],
          ['date', '<=', $data['date2']]
        ])->get();

        $view = view('search', ['items' => $schedule])->render();
        return (new Response($view));

        } else {
            $view = view('result', ['html' => $this->html])->render();
            return (new Response($view));
        }
    }

    private function checkForm($data, $fieldsToCheck)
    {
        $validator = new Validator;
        $validation = $validator->validate($data, $fieldsToCheck);

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errs = $errors->firstOfAll();
            $this->html = 'Заполните все поля!';
            foreach($errs as $key=>$err) {
                $this->html .= $err;
                $this->html .= '<br>';
            }

            return false;
        } else {

            return true;
        }
    }
}
