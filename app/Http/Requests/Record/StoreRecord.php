<?php

namespace App\Http\Requests\Record;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecord extends FormRequest
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
            'client_id' => 'required',
            'date' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'Поле "клиент" обязательно для заполнения.',
            'date.required' => 'Поле "дата" обязательно для заполнения.',
            'time_start.required' => 'Поле "время начала" обязательно для заполнения.',
            'time_finish.required' => 'Поле "время окончания" обязательно для заполнения.',
        ];
    }
}
