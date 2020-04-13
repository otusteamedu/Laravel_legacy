<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Support\Arr;
class FormRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /* public function authorize()
     {
         return false;
     }*/

    public function getFormData()
    {
//        return $this->except(['_token', '_method']);
        $data = $this->request->all();
        $data = Arr::except($data, [
            '_token',
            '_method'
        ]);
        return $data;
    }
}
