<?php

namespace App\Http\Controllers\Cms\Towns\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreTownRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'name' => 'required|max:100',  //unique:town,name|
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();
        $data = Arr::except($data, ['_token',]);

        return $data;
    }

}
