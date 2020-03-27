<?php

namespace App\Http\Controllers\API\Cms\Image\Requests;

use App\Http\Requests\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'topics' => 'bail|array',
            'colors' => 'bail|array',
            'interiors' => 'bail|array',
            'tags' => 'bail|array',
            'owner' => 'bail|integer',
            'image' => 'bail|file|image|mimes:' . config('validation.upload.mimes') . '|min:' . config('validation.upload.min_size') . '|max:' . config('validation.upload.max_size'),
            'publish' => 'bail|integer',
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
