<?php


namespace App\Http\Controllers\Cms\Tariffs\Requests;


class UpdateTariffRequest extends StoreTariffRequest
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
            'name' => 'required|unique:tariffs,name|max:100',
            'condition' => 'required'
        ];
    }
}
