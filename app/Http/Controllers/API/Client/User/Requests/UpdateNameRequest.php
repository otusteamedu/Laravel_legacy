<?php

namespace App\Http\Controllers\API\Client\User\Requests;


use App\Http\Requests\FormRequest;

class UpdateNameRequest extends FormRequest
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
            'name' => 'required|string|min:' . config('validation.name.min','') . '|max:' . config('validation.name.max','')
        ];
    }
}
