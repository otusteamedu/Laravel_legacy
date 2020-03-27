<?php

namespace App\Http\Controllers\API\Cms\Setting\Requests;

use App\Http\Requests\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'key_name' => 'bail|required|unique:settings,key_name,' . $id . '|min:' . config('validation.setting.min') . '|max:' . config('validation.setting.max') . '|regex:' . config('validation.setting.pattern'),
            'display_name' => 'bail|required|unique:settings,display_name,' . $id . '|min:' . config('validation.name.min') . '|max:' . config('validation.name.max'),
//            'type' => 'bail|required|string|max:' . config('validation.name.max'),
            'group_id' => 'integer'
        ];
    }
}
