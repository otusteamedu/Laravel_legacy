<?php

namespace App\Http\Requests;

use App\Models\User\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $roles = Role::select('id')->get();
        $arrayRoles = [];

        foreach ($roles as $role) {
            $arrayRoles[] = $role->id;
        }

        return [
            'email' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'role' => ['required', Rule::in($arrayRoles)],
        ];
    }
}
