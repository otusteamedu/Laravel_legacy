<?php

namespace App\Http\Controllers\Students\Requests;

use App\Models\Student;
use Closure;

class StoreStudentRequest extends StudentRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'group_id.*' => ['required', 'integer', 'min:1'],
            'id_number' => [
                'required',
                'integer',
                'min:0',
                /** Проверка уникальности по действующим студенческим номерам */
                function (string $attribute, int $value, Closure $fail): void {
                    if (Student::whereIdNumber($value)->exists()) {
                        $fail(__('validation.id_number_unique'));
                    }
                },
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return array_merge(
            [
                'last_name.required' => __('validation.last_name_required'),
                'name.required' => __('validation.name_required'),
                'name.max' => __('validation.name_max'),
                'second_name.max' => __('validation.second_name_max'),
                'group_id.required' => __('validation.group_required'),
                'id_number.required' => __('validation.id_number_required'),
            ],
            parent::messages()
        );
    }
}
