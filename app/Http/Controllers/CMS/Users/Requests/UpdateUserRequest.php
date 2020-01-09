<?php

/*
 * Вызывался стандартный FormRequest :
 * use Illuminate\Foundation\Http\FormRequest;
 * но мы же его переопределили на свой :
 */
namespace App\Http\Controllers\CMS\Users\Requests;
use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

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
            'source'=>['required', Rule::in(config('shop.sources'))],
            'type'=>['required', Rule::in(config('shop.types'))],
            'name'=>'required|max:50',
            'operator'=>['required', Rule::in(config('shop.operators'))],
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
        $sources = implode(", ", config('shop.sources'));
        $types = implode(", ", config('shop.types'));
        $operators = implode(", ", config('shop.operators'));

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
