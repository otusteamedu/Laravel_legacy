<?php


namespace App\Http\Controllers\Cms\Users\Requests;


class UpdateUserRequest extends StoreUserRequest
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
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email|max:100',
            'phone' => 'required|unique:users,phone|max:15',
            'password' => 'required',
        ];
    }
}
