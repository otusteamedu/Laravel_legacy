<?php

namespace App\Http\Controllers\Api\Cms\Category\Requests;

use App\Http\Requests\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'title' => 'bail|required|unique:categories,title|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'alias' => 'bail|required|unique:categories,alias|min:' . config('validation.alias.min') . '|max:' . config('validation.alias.max') . '|regex:' . config('validation.alias.pattern'),
            'image' => 'bail|required|file|image|mimes:' . config('validation.upload.mimes') . '|min:' . config('validation.upload.min_size') . '|max:' . config('validation.upload.max_size'),
            'publish' => 'bail|required|integer',
            'description' => 'max:' . config('validation.description.max'),
            'keywords' => 'max:' . config('validation.keywords.max')
        ];
    }
}
