<?php

namespace App\Http\Controllers\API\Cms\User\Requests;


use App\Http\Requests\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'name' => 'bail|required|string|min:' . config('validation.name.min','') . '|max:' . config('validation.name.max',''),
            'email' => 'bail|required|email|max:' . config('validation.email.max','') . '|unique:users,email,' . $id,
            'old_password' => 'bail|string|min:' . config('validation.password.min','') . '|max:' . config('validation.password.max',''),
            'password' => 'required_with:old_password|string|min:' . config('validation.password.min','') . '|max:' . config('validation.password.max','') . '|confirmed'
        ];
    }
}
