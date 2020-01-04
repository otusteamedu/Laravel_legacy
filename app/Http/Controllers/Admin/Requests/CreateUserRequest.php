<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * Class StoreUserRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class CreateUserRequest extends FormRequest
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
            'username' => 'unique:users|required',
            'email' => 'unique:users|email|required',
            'role_id' => 'integer|required',
            'password' => 'required'
        ];
    }

    public function getData()
    {
        return Arr::only($this->all(), [
            'username',
            'email',
            'role_id',
            'password'
        ]);
    }
}
