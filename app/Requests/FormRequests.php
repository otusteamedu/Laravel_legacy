<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    public function getFormData()
    {
        $data = $this->request->all();

        return $data;
    }
}
