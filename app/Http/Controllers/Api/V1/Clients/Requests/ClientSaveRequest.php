<?php

namespace App\Http\Controllers\Api\V1\Clients\Requests;

use App\Http\Requests\FormRequest;

class ClientSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:100',
        ];
    }

}
