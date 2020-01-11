<?php

namespace App\Http\Controllers\Api\Cms\Setting\Requests;

use App\Http\Requests\FormRequest;

class SetImageSettingValueRequest extends FormRequest
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
            'key_name' => 'bail|required|min:' . config('validation.setting.min') . '|max:' . config('validation.setting.max') . '|regex:' . config('validation.setting.pattern'),
            'image' => 'bail|file|image|mimes:' . config('validation.upload.mimes') . '|min:' . config('validation.upload.min_size') . '|max:' . config('validation.upload.max_size'),
        ];
    }
}
