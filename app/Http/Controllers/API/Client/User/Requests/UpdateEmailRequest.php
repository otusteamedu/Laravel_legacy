<?php

namespace App\Http\Controllers\API\Client\User\Requests;


use App\Http\Requests\FormRequest;

class UpdateEmailRequest extends FormRequest
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
        $userId = auth()->user()->id;

        return [
            'email' => 'required|email|max:' . config('validation.email.max','') . '|unique:users,email,' . $userId
        ];
    }
}
