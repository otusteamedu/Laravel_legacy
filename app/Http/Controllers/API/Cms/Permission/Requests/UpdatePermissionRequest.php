<?php

namespace App\Http\Controllers\API\Cms\Permission\Requests;

use App\Http\Requests\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'name' => 'bail|required|unique:permissions,name,' . $id . '|min:' . config('validation.name.min') . '|max:' . config('validation.name.max') . '|regex:' . config('validation.alias.pattern'),
            'display_name' => 'bail|required|unique:permissions,display_name,' . $id . '|min:' . config('validation.name.min') . '|max:' . config('validation.name.max'),
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
