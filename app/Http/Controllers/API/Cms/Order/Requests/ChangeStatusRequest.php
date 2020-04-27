<?php

namespace App\Http\Controllers\API\Cms\Order\Requests;

use App\Http\Requests\FormRequest;

class ChangeStatusRequest extends FormRequest
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
            'status' => 'required|integer',
            'list' => 'required|boolean'
        ];
    }
}
