<?php

namespace App\Http\Controllers\Admin\Countries\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateCountryRequest extends StoreCountryRequest
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