<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    public function getFormData()
    {
        $data = $this->request->all();
        $data = Arr::except($data, [
           '_token',
           '_method'
        ]);

        return $data;
    }
}
