<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
