<?php

namespace App\Http\Controllers\Cms\Tasks\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class TaskUpdateRequest extends FormRequest
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
            'name' => 'required',
            'project_id' => 'required',
            'user_id' => 'required',
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();
        $data = Arr::except($data, [
            '_token',
            '_method'
        ]);
        return $data;
    }

    public function messages()
    {
        return [
            'name.required' => "Заполните название",
            'project_id.required' => "Выберите проект",
            'user_id.required' => "Выберите ответственного",
        ];
    }
}
