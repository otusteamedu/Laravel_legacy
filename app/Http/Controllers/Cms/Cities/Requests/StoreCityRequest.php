<?php


namespace App\Http\Controllers\Cms\Cities\Requests;


use App\Http\Requests\FormRequest;

class StoreCityRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|unique:cities,name|max:100',
            'country_id' => 'required'
        ];
    }

}
