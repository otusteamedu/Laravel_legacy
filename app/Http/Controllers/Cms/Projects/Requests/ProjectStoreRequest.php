<?php

namespace App\Http\Controllers\Cms\Projects\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ProjectStoreRequest extends FormRequest
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
            'name'       => 'required',
            'report_day' => 'integer|min:1|max:31|required'
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();
        $data = Arr::except($data, [
            '_token',
        ]);
        return $data;
    }

    public function messages()
    {
        return [
            'name.required'       => "Заполните название проекта",
            'report_day.required' => "Заполните дату отчета",
            'report_day.integer'  => "Поле отчета должно быть числом",
            'report_day.min'      => "Число отчета должно быть больше 0",
            'report_day.max'      => "Число отчета должно быть меньше 31",
        ];
    }


}
