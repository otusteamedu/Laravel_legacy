<?php

namespace App\Http\Controllers\API\Client\User\Requests;


use App\Http\Requests\FormRequest;

class LikesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !!auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'items' => 'array'
        ];
    }
}
