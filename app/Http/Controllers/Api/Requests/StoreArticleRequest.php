<?php

namespace App\Http\Controllers\Api\Requests;


use App\Http\Requests\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'category_id' => 'required',
            'intro_text' => 'required'
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['user_id'] = \Auth::id();

        return $data;
    }
}
