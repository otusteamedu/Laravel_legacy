<?php

namespace App\Http\Controllers\Api\API\Setting\Requests;

use App\Http\Requests\FormRequest;

class CreateSettingRequest extends FormRequest
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
            'key_name' => 'bail|required|unique:settings,key_name|min:' . config('validation.setting.min') . '|max:' . config('validation.setting.max') . '|regex:' . config('validation.setting.pattern'),
            'display_name' => 'bail|required|unique:settings,display_name|min:' . config('validation.name.min') . '|max:' . config('validation.name.max'),
            'type' => 'bail|required|string|max:' . config('validation.name.max'),
            'group_id' => 'integer'
        ];
    }
}
