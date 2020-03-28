<?php


namespace App\Http\Controllers\Cms\Categories\Requests;


class UpdateCategoryRequest extends StoreCategoryRequest
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

    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name|max:100',
            'description' => ''
        ];
    }
}
