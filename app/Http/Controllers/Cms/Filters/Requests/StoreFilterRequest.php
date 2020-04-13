<?php

namespace App\Http\Controllers\Cms\Filters\Requests;

use App\Http\Requests\FormRequest;

class StoreFilterRequest extends FormRequest
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
            'name' => 'required|max:100|min:5|unique:filters',
            'description' => 'required|min:3',
            'filter_type_id' => 'required'
        ];
    }


    /** Если нужно что-то изменить
     * @return bool|mixed
     */
    public function getFormData(): array
    {
        /*parent::getFormData();
        $data['created_user_id'] = \Auth::id();

        return $data;*/
        return array_merge(parent::getFormData(), [
//            'locale' => config('app.locale'),
//            'author_id' => $this->user()->id,
        ]);

    }

}
