<?php

namespace App\Http\Controllers\Cms\Filters\Requests;



use App\Http\Requests\FormRequest;

class UpdateFilterRequest extends FormRequest
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
            'name' => 'required|max:100|min:5',
            'description' => 'required|min:3',
            'filter_type_id' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return array_merge(parent::getFormData(), [
//            'locale' => config('app.locale'),
//            'author_id' => $this->user()->id,
        ]);
    }

}
