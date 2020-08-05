<?php


namespace App\Http\Controllers\Api\V1\Clients\Requests;


use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ClientStoreRequest extends ClientSaveRequest
{

    public function getFormData()
    {
        $data = parent::getFormData();

        $data['created_at'] = Carbon::create()->subDay();
        $data['balance'] = 0;
        $data['password'] = Hash::make(app(\Faker\Generator::class)->password);

        return $data;
    }
}
