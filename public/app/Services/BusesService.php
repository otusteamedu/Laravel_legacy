<?php

namespace App\Services;

use App\Models\Transport\Bus;
use App\Models\Validator\BusValidator;
use Illuminate\Http\Request;

class BusesService
{
    public function getList()
    {
        return Bus::paginate(10);
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
}
