<?php
namespace App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{

    public function getFormData(){
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        return $data;
    }

    public function messages()
    {
        return [
            'title.required' => 'Не заполнено обязательное поле - :attribute .',
            'slug.required' => 'Не заполнено обязательное поле - :attribute .'
        ];
    }

}
