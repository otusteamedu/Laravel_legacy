<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use \Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    public function getFromData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
            '_method'
        ]);

        return $data;
    }
}
