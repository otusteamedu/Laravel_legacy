<?php


namespace App\Http\Controllers\Cms\Countries\Requests;


class UpdateCityRequest extends StoreCityRequest
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
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ];
    }
}
