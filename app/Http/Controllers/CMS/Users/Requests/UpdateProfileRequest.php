<?php

/*
 * Вызывался стандартный FormRequest :
 * use Illuminate\Foundation\Http\FormRequest;
 * но мы же его переопределили на свой :
 */
namespace App\Http\Controllers\CMS\Users\Requests;
use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>'required|min:2',
            'phone'=>'required|min:10',
            'email'=>'required|min:2',
            'address'=>'required|min:3',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'name.required' => 'Укажите своё имя',
            'name.min' => 'Желательно прописать своё полное ФИО',

            'phone.required' => 'Укажите номер мобильного телефона',
            'phone.min' => 'Полный номер мобильного телефона должен содержать не менее 10 символов.',

            'email.required' => 'Укажите свою эл. почту',
            'email.min' => 'Ошибка в написании эл.почты',

            'address.required' => 'Укажите где Вы живёте',
            'address.min' => 'Укажите хотя бы название населённого пункта : например города или деревни.',
        ];
    }
}
