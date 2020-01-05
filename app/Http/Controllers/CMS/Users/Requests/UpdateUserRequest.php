<?php

/*
 * Вызывался стандартный FormRequest :
 * use Illuminate\Foundation\Http\FormRequest;
 * но мы же его переопределили на свой :
 */
namespace App\Http\Controllers\CMS\Users\Requests;
use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

// получи предопределённые списки значений из config/shop.php
define('USER_SOURCES', config('shop.sources'));
define('USER_TYPES', config('shop.types'));
define('USER_OPERATORS', config('shop.operators'));

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//БЫЛО false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source'=>['required', Rule::in(USER_SOURCES)],
            'type'=>['required', Rule::in(USER_TYPES)],
            'name'=>'required|max:50',
            'operator'=>['required', Rule::in(USER_OPERATORS)],
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        //  собери строку из элементов массива
        $sources = implode(", ", USER_SOURCES);
        $types = implode(", ", USER_TYPES);
        $operators = implode(", ", USER_OPERATORS);

        return [
            'source.required' => 'Укажите сайт',
            'source.in' => 'Укажите сайт из списка : '.$sources,

            'type.required' => 'Укажите тип',
            'type.in' => 'Укажите тип из списка : '.$types,

            'name.required' => 'Укажите имя',
            'name.max' => 'Имя не должно превышать 50 символов',

            'operator.required' => 'Укажите оператора',
            'operator.in' => 'Укажите оператора из списка : '.$operators,
        ];
    }
}
