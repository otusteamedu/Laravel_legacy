<?php

namespace App\Http\Controllers\API\Cms\SettingGroup\Requests;

use App\Http\Requests\FormRequest;

class UpdateSettingGroupRequest extends FormRequest
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
            'title' => 'bail|required|unique:setting_groups,title,' . $id . '|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'alias' => 'bail|required|unique:setting_groups,alias,' . $id . '|min:' . config('validation.alias.min') . '|max:' . config('validation.alias.max') . '|regex:' . config('validation.alias.pattern'),
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
