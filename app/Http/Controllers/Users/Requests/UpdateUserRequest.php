<?php

namespace App\Http\Controllers\Users\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore(request()->user()->id),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * @return array
     */
    public function getFormData()
    {
        $data = $this->request->all();

        $data = \Arr::except($data, [
            '_token',
            '_method',
            'password_confirmation',
        ]);

        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}