<?php

namespace App\Http\Controllers\Api\Cms\SettingGroup\Requests;

use App\Http\Requests\FormRequest;

class CreateSettingGroupRequest extends FormRequest
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
            'title' => 'bail|required|unique:setting_groups,title|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
