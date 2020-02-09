<?php

namespace App\Http\Controllers\Cms\User\User\Requests;

use Arr;
use Hash;
use Illuminate\Foundation\Http\FormRequest;
use Str;

/**
 * Class StoreGroupRequest
 * @package App\Http\Controllers\Cms\User\Group\Requests
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];
    }

    public function getFormData(): array
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
            'password_confirmation'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        return $data;
    }
}
