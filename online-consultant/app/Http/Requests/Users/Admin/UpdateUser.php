<?php

namespace App\Http\Requests\Users\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
            'name'  => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->route()->parameter('user'))
            ],
            'roles' => 'required'
        ];
    }
}
