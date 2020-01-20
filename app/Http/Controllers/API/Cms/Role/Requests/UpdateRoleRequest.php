<?php

namespace App\Http\Controllers\API\Cms\Role\Requests;

use App\Http\Requests\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'bail|required|unique:roles,name,' . $id . '|min:' . config('validation.name.min') . '|max:' . config('validation.name.max') . '|regex:' . config('validation.alias.pattern'),
            'display_name' => 'bail|required|unique:roles,display_name,' . $id . '|min:' . config('validation.name.min') . '|max:' . config('validation.name.max'),
            'description' => 'bail|max:' . config('validation.description.max'),
            'permissions' => 'required|array'
        ];
    }
}
