<?php

namespace App\Http\Controllers\API\Cms\User\Requests;


use App\Http\Requests\FormRequest;

class UserSocialRequest extends FormRequest
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
            'name' => 'bail|required|string|min:' . config('validation.name.min','') . '|max:' . config('validation.name.max',''),
            'email' => 'bail|required|email|max:' . config('validation.email.max','') . '|unique:users,email',
            'password' => 'bail|required|string|min:' . config('validation.password.min','') . '|max:' . config('validation.password.max','') . '|confirmed',
            'social_id' => 'bail|required|string',
            'service' => 'required|string'
        ];
    }
}
