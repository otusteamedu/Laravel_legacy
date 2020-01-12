<?php

namespace App\Http\Controllers\Profile\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;


/**
 * Class UpdateCommentRequest
 * @package App\Http\Controllers\Profile\Requests
 */
class UpdateCommentRequest extends FormRequest
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
            'text' => 'required|string'
        ];
    }


    /**
     * Возвращает нужные данные для обновления данныз пользователя
     *
     */
    public function getData()
    {
       $data = Arr::only($this->all(), [
           'text'
       ]);
       return $data;
    }
}
