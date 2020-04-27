<?php

namespace App\Http\Controllers\API\Client\User\Requests;


use App\Http\Requests\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'bail|required|email|max:' . config('validation.email.max',''),
            'password' => 'required|string|min:' . config('validation.password.min','') . '|max:' . config('validation.password.max','')
        ];
    }
}
