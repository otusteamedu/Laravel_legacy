<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;


/**
 * Class UpdateUserRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class UpdateUserRequest extends FormRequest
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
            'email' => 'email|required',
            'role_id' => 'integer|required',
        ];
    }


    /**
     * Возвращает нужные данные для обновления данныз пользователя
     *
     */
    public function getData()
    {
       $data = Arr::only($this->all(), [
           'email',
           'role_id'
       ]);
       return $data;
    }
}
