<?php

namespace App\Http\Controllers\Admin\Cities\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateCityRequest extends StoreCityRequest
{

    /**
     * @return array
     */
    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        return $data;
    }
}