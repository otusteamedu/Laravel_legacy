<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'phone_number' => 'required|max:15',
            'email' => 'max:255',
            'material' => 'max:255'
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => 'Поле "фамилия" обязательно для заполнения.',
            'first_name.required' => 'Поле "имя" обязательно для заполнения.',
            'phone_number.required' => 'Поле "номер телефона" обязательно для заполнения.',
        ];
    }
}
