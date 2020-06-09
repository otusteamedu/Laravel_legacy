<?php

namespace App\Http\Controllers\Admin\Requests;


use App\Http\Requests\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'title' => 'required|max:255',
            'name' => 'required|max:255',
        ];
    }

    /**
     * Validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Необходимо указать "Название"',
            'title.max' => 'Максимальное количество символов для поля "Название" :max',
            'name.required' => 'Необходимо указать "Алиас"',
            'name.max' => 'Максимальное количество символов для поля "Алиас" :max',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();

        return $data;
    }
}
