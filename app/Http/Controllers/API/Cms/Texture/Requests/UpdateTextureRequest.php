<?php

namespace App\Http\Controllers\API\Cms\Texture\Requests;

use App\Http\Requests\FormRequest;

class UpdateTextureRequest extends FormRequest
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
            'name' => 'bail|required|unique:textures,name,' . $id . '|min:' . config('validation.name.min') . '|max:' . config('validation.name.max'),
            'price' => 'bail|required|numeric',
            'width' => 'bail|required|numeric',
            'thumb' => 'bail|file|image|mimes:jpeg,png|min:' . config('validation.upload.min_size.min') . '|max:' . config('validation.upload.max_size'),
            'sample' => 'bail|file|image|mimes:jpeg,png|min:' . config('validation.upload.min_size.min') . '|max:' . config('validation.upload.max_size'),
            'background' => 'bail|file|image|mimes:jpeg,png|min:' . config('validation.upload.min_size.min') . '|max:' . config('validation.upload.max_size'),
            'description' => 'max:' . config('validation.text.max')
        ];
    }
}
