<?php

namespace App\Http\Controllers\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * Class LoginFormRequest
 * @package App\Http\Controllers\Auth\Requests
 */
class LoginFormRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return Arr::only($this->all(),[
            'email',
            'password'
        ]);
    }
}
