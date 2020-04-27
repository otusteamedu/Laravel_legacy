<?php

namespace App\Http\Controllers\API\Client\Cart\Requests;

use App\Http\Requests\FormRequest;

class SetQtyRequest extends FormRequest
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
            'id' => 'bail|required|integer',
            'qty' => 'required|integer'
        ];
    }
}
