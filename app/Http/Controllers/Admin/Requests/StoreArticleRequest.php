<?php

namespace App\Http\Controllers\Admin\Requests;


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
            'title' => 'required|max:250',
            'category_id' => 'required',
            'intro_text' => 'required'
        ];
    }

//    /**
//     * Получить сообщения об ошибках для определённых правил проверки.
//     *
//     * @return array
//     */
//    public function messages()
//    {
//        return [
//            'title.required' => 'Необходимо указать заголовок',
//            'title.max' => 'Максимальное количество символов для поля "Заголовок" :max',
//            'category_id.required' => 'Необходимо выбрать категорию',
//            'intro_text.required' => 'Необходимо указать вступительный текст'
//        ];
//    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['user_id'] = \Auth::id();

        return $data;
    }
}
