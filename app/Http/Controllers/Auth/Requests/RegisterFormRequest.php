<?php

namespace App\Http\Controllers\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * Class RegisterFormRequest
 * @package App\Http\Controllers\Auth\Requests
 */
class RegisterFormRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'password_confirm' => 'required|string|same:password',
            'name' => 'required|string',
            'role_id' => 'required|in:1,2',
            'terms_agree' => 'required|accepted',
        ];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return Arr::only($this->all(),[
            'email',
            'password',
            'name',
            'role_id'
        ]);
    }
}
