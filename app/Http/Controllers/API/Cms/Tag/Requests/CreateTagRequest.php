<?php

namespace App\Http\Controllers\Api\Cms\Tag\Requests;

use App\Http\Requests\FormRequest;

class CreateTagRequest extends FormRequest
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
            'title' => 'bail|required|unique:tags,title|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'publish' => 'bail|required|integer',
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
